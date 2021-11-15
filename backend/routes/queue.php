<?php
/** @author Vladimir Martynenko */

  const TIMEZONE = "America/New_York";
  const POSITION_NOT_NULL = "Visit.Position IS NOT NULL";
  const NO_ADVISOR_ID = "Missing an id of a advisor";

  function makeQueueObject($advisor, $visits){
    $result = (object)['advisorId' => $advisor->getUid()];
    $result->advisorName = $advisor->getName();
    $result->pictureUrl = $advisor->getPictureUrl();
    $visitCount = count($visits);
    $queue = [];
    $student = null;
    for($i = 0; $i < $visitCount; $i++ ){
      $position = $visits[$i]->getPosition();
      if(!isset($position)){ continue; }
      $student = StudentQuery::create()->findOneByUid($visits[$i]->getStudentId());
      $student = [
        'id' => $student->getUid(),
        'name' => $student->getName(),
        'position' => $position
      ];
      $queue[] = (object)$student;
    }
    $result->EstimatedWaitTime = count($queue) * 10;
    $result->queue = $queue;
    return $result;
  } // makeQueueObject

  function invite($advisorId){
    $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
    if(!$advisor){
      returnUserError("$advisorId is not a valid advisor id if an active queue.");
    }
    $result = (object)['advisorId' => $advisorId];
    $result->advisorName = $advisor->getName();
    $result->pictureUrl = $advisor->getPictureUrl();
    $visits = VisitQuery::create()->where(POSITION_NOT_NULL)
                                  ->filterByAdvisorId($advisorId)
                                  ->orderByPosition()
                                  ->find();
    if(empty($visits)){
      returnUserError("The $advisorId queue is empty");
    }
    $visitsCount = count($visits);
    if ($visits[0]->getPosition() === 0){
      returnUserError("The previous visit is not yet complete for adviser $advisorId");
    }
    $visits[0]->setInvitedAt(new DateTime("now", new DateTimeZone(TIMEZONE)));
    for($i = 0; $i < $visitsCount; $i++){
      $visits[$i]->setPosition($i);
      $visits[$i]->save();
    }
    return makeQueueObject($advisor, $visits);
  } // invite

  function complete($advisorId){
    $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
    if(!$advisor){
      returnUserError("$advisorId is not a valid advisor id if an active queue.");
    }
    $result = (object)['advisorId' => $advisorId];
    $result->advisorName = $advisor->getName();
    $result->pictureUrl = $advisor->getPictureUrl();
    $visits = VisitQuery::create()->where(POSITION_NOT_NULL)
                                  ->filterByAdvisorId($advisorId)
                                  ->orderByPosition()
                                  ->find();
    if(empty($visits)){
      returnUserError("The $advisorId queue is empty");
    }
    $visit = $visits[0];
    if ($visit->getPosition() !== 0){
      returnUserError("There are not invited students $advisorId");
    }
    $visit->setCompleteAt(new DateTime("now", new DateTimeZone(TIMEZONE)));
    $visit->setPosition(null);
    $visit->save();
    return makeQueueObject($advisor, $visits);
  } // complete

  function cancel($studentId){
    $visit = VisitQuery::create()->where(POSITION_NOT_NULL)
                                 ->findOneByStudentId($studentId);
    if(!isset($visit)){
      returnUserError("$studentId was not found in any queues");
    }
    $advisorId = $visit->getAdvisorId();
    $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
    if (!isset($advisor)){
      sendServerError("Failed to find advisor with id $advisorId");
    }
    $position = $visit->getPosition();
    $visits = VisitQuery::create()->where(POSITION_NOT_NULL)
                                  ->filterByAdvisorId($advisorId)
                                  ->orderByPosition()
                                  ->find();
    $visit->setCompleteAt(new DateTime("now", new DateTimeZone(TIMEZONE)));
    $visit->setPosition(null);
    $visit->save();
    if($position !== 0){
      $visitsCount = count($visits);
      for($i = $position + 1; $i < $visitsCount; $i++){
        $visits[$i]->setPosition($i - 1);
        $visits[$i]->save();
      }
    }
    return makeQueueObject($advisor, $visits);
  } // cancel

  function moveToPosition($position, $studentId, $queueId) {
    if($position < 0){
      returnUserError("Position must be a positive number or 0");
    }
    $advisor = EmployeeQuery::create()->findOneByUid($queueId);
    if(!$advisor){
      returnUserError("$queueId is not a valid queue id if an active queue.");
    }
    $result = (object)['advisorId' => $queueId];
    $result->advisorName = $advisor->getName();
    $result->pictureUrl = $advisor->getPictureUrl();
    $visits = VisitQuery::create()->where(POSITION_NOT_NULL)
                                  ->filterByAdvisorId($queueId)
                                  ->orderByPosition()
                                  ->find();
    $visitsCount = count($visits);
    if($position > $visitsCount){
      returnUserError("There are fewer students queue than " . ($position + 1));
    }
    $currentIndex = null;
    for($i = 0; $i < $visitsCount; $i++){
      if ($visits[$i]->getStudentId() == $studentId){
        $currentIndex = $i;
        break;
      }
    }
    if($position === $currentIndex) {
      return makeQueueObject($advisor, $visits);
    }
    if($position > $currentIndex){
      $aside = $visits[$currentIndex];
      for($i = $currentIndex; $i < $position; $i++){
        $visits[$i] = $visits[$i + 1];
        $visits[$i]->setPosition($i);
        $visits[$i]->save();
      }
      $visits[$position] = $aside;
      $visits[$position]->setPosition($position);
      $visits[$position]->save();
    } else {
      $aside = $visits[$currentIndex];
      for($i = $currentIndex; $i > $position; $i--){
        $visits[$i] = $visits[$i - 1];
        $visits[$i]->setPosition($i);
        $visits[$i]->save();
      }
      $visits[$position] = $aside;
      $visits[$position]->setPosition($position);
      $visits[$position]->save();
    }
    return makeQueueObject($advisor, $visits);
  } // moveToPosition

  // TODO Finish up
  function enqueue($advisorId, $studentId, $modalityId, $reasonId, $customReason){
    $advisor = EmployeeQuery::create()->
      where('Employee.is_grad_advisor IS NOT NULL')->
      findOneByUid($advisorId);
    if($advisor === null){
      returnUserError("Advisor with id $advisorId not found");
    }
    if(!checkCurrentAdvisor($advisorId)){
      returnUserError("Advisor with id $advisorId is not accepting new walkins");
    }
    $student = StudentQuery::create()->findOneByUid($studentId);
    if($student === null){
      returnUserError("Student with id $studentId not found");
    }
    $modality = ModalityQuery::create()->findOneById($modalityId);
    if($modality === null) {
      returnUserError("Modality with is $modalityId not found");
    }
    $reason = ReasonQuery::create()->findOneById($reasonId);
    if($reason === null){
      returnUserError("Reason with id $reasonId not found");
    }
    $queue = getQueue($advisorId);
    if(count($queue->queue) === 0) {
      $position = 1;
    } else {
      $position = end($queue->queue)->position + 1;
    }
    $visit = new Visit();
    $visit->setId(Ramsey\Uuid\Uuid::uuid4());
    $visit->setEmployee($advisor);
    $visit->setStudent($student);
    $visit->setModality($modality);
    $visit->setReason($reason);
    $visit->setCreatedAt(date("Y-m-d H:i:s"));
    $visit->setPosition($position);
    if($customReason !== null){
      $visit->setCustomReason($customReason);
    }
    $visit->save();
    return getAllQueues();
  } // enqueue

  function checkCurrentAdvisor($advisorId){
    $now = date("Y-m-d H:i:s");
    $hour = WalkinHourQuery::create()->
        filterByAdvisorId($advisorId)->
        filterByStartsAt(array('max' => $now))->
        filterByEndsAt(array('min' => $now))->
        findOne();
    return $hour !== null;
    // var_dump($hour);
  } // checkCurrentAdvisor

  // queueId is a uid of advisor
  function getQueue($queueId) {
    $advisor = EmployeeQuery::create()->findOneByUid($queueId);
    $advisorRole = RoleQuery::create()->findOneByName("Advisor");
    if(!$advisor || $advisor->getRoleId() !== $advisorRole->getId()){
      returnUserError("$queueId is not a valid queue id.");
    }
    $visits = VisitQuery::create()->where(POSITION_NOT_NULL)
                                  ->filterByAdvisorId($queueId)
                                  ->orderByPosition()
                                  ->find();
    return makeQueueObject($advisor, $visits);
  } // getQueue

  function sortQueue($studentsArray){
    $studentsArrayCount = count($studentsArray);
    $result = null;
    for ($i = 0; $i < $studentsArrayCount; $i++){
      if(!isset($studentsArray["$i"])){
        $result[] = $studentsArray["$i"];
      }
    }    
    return $result;
  } // sortQueue

  function getAllQueues() {
    $advisorIds = VisitQuery::create()->
      where(POSITION_NOT_NULL)->
      groupByAdvisorId()->
      select(array('Visit.advisor_id'))->
      find();
    $allAdvisors = EmployeeQuery::create()->
      where('Employee.is_grad_advisor IS NOT NULL')->
      select(array('Employee.Uid'))->
      find();
    foreach($allAdvisors as $advisor){
      if(checkCurrentAdvisor($advisor) && !$advisorIds->contains($advisor)){
        $advisorIds->prepend($advisor);
      }
    }
    $result = [];
    foreach($advisorIds as $advisorId) {
      $result[] = getQueue($advisorId);
    }
    return $result;
  } // getAllQueues

  // function getAllQueues() {
  //   $visits = VisitQuery::create()->where(POSITION_NOT_NULL)->orderByAdvisorId()->find();
  //   $queues = [];
  //   $advisorId = null;
  //   $lastAdvisorId = null;
  //   $studentArray = null;
  //   $studentsArray = [];
  //   $visitsCount = count($visits);
  //   // echo "Visit count: $visitsCount\n";
  //   for($j = 0; $j < $visitsCount; $j++) {
  //     $visit = $visits[$j];
  //     $advisorId = $visit->getAdvisorId();
  //     if($advisorId !== $lastAdvisorId){
  //       // echo "AdvisorId: $advisorId\n";
  //       if($lastAdvisorId !== null) {
  //         $studentArrayCount = count($studentsArray);
  //         // echo "studentsArray: $studentArrayCount\n";
  //         $queueObject->studentsInTheQueue = sortQueue($studentsArray);
  //       }
  //       $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
  //       $queue = [];
  //       $queue['advisorName'] = $advisor->getName();
  //       $queue['advisorId'] = $advisor->getUid();
  //       $queue['pictureUrl'] = $advisor->getPictureUrl();
  //       $queueObject = (object)$queue;
  //       $queueLength = count($studentsArray);
  //       $queueObject->EstimatedWaitTime = ($queueLength * 10);  
  //       $queues[] = $queueObject;
  //       $studentsArray = [];
  //       $lastAdvisorId = $advisorId;
  //     }
  //     $student = StudentQuery::create()->findOneByUid($visit->getStudentId());
  //     $studentArray = ['id' => $student->getUid(),
  //                      'studentDisplayName' => $student->getName(),
  //                      'position' => $visit->getPosition(),
  //                      'emailAddress' => $student->getUid() . "@rit.edu"];
  //     $studentsArray[$visit->getPosition()] = (object)$studentArray;
  //     if($j === $visitsCount - 1){
  //       $queueObject->studentsInTheQueue = sortQueue($studentsArray);
  //     }
  //   }
  //   return($queues);
  // } // getAllQueues

  function processGetRoute($pathComponents, $requestParameters){
    $queueId = array_shift($pathComponents);
    if (!$queueId) {
      returnResponse(getAllQueues());
    }
    returnResponse(getQueue($queueId));
  }

  function processPostRoute($operation, $pathComponents, $requestParameters){
    switch ($operation) {
      case 'movetoposition':
        if (!isset($_POST['position'])){
          returnUserError("Missing new position argument");
        }
        if (empty($_POST['studentId'])){
          returnUserError("Missing an id of a student to move");
        }
        if (empty($_POST['advisorId'])){
          returnUserError(NO_ADVISOR_ID);
        }
        returnResponse(moveToPosition($_POST['position'], $_POST['studentId'], $_POST['advisorId']));
        break;
      case 'invite':
        if (empty($_POST['advisorId'])){
          returnUserError(NO_ADVISOR_ID);
        }
        returnResponse(invite($_POST['advisorId']));      
        break;
      case 'complete':
        if (empty($_POST['advisorId'])){
          returnUserError(NO_ADVISOR_ID);
        }
        returnResponse(complete($_POST['advisorId']));
        break;
      case 'cancel':
        if (empty($_POST['studentId'])){
          returnUserError('Missing an id of a student');
        }
        returnResponse(cancel($_POST['studentId']));
        break;
      case "enqueue":
        if (!isset($_POST['advisorId'])){
          returnUserError("Missing advisorId");
        }
        if (!isset($_POST['studentId'])){
          returnUserError("Missing studentId");
        }
        if (!isset($_POST['reasonId'])){
          returnUserError("Missing reasonId");
        }
        if (!isset($_POST['modalityId'])){
          returnUserError("Missing modalityId");
        }
        $customReason = isset($_POST['customReason'])? $_POST['customReason'] : null;
        returnResponse(enqueue(
          $_POST['advisorId'],
          $_POST['studentId'],
          $_POST['reasonId'],
          $_POST['modalityId'],
          $customReason
        ));
        break;  
      default:
        returnUserError("$operation is not a supported operation for queue endpoint.");
        break;
    }
  }