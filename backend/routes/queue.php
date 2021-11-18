<?php
/**
 * @author Vladimir Martynenko
 *
 * Methods related to Queues
 * 
 * Requests for '/queue' endpoint:  
 * 
 * GET '/' - Get all queues  
 *
 * Returns JSON array containing queue objects  
 * 
 * GET '/{:advisorId}' - get a queue for {:advisorId}
 * 
 * Returns JSON containing:  
 * - advisorId,  
 * - AdvisorName,  
 * - pictureUrl,
 * - EstimatedWaitTime,
 * - queue - array of students in queue. Each line contains 'id', 'name', and 'position'
 *
 * POST '/movetoposition' - move student into new position  
 * Body parameters:  
 * - position - new position,  
 * - studentId - studentId,  
 * - advisorId - advisorId  
 * 
 * Returns JSON with update queue  
 * 
 * POST '/invite' - Invite student to adviser  
 * Body parameters:   
 * - advisorId - advisorId  
 * 
 * Returns updated JSON queue  
 * 
 * POST '/complete' - complete the visit  
 * Body parameters:  
 * - advisorId - advisorId  
 * 
 * Returns updated JSON queue  
 * 
 * POST '/cancel' - cancels the visit without seeing advisor  
 * Body parameters:  
 * - studentId - studentId  
 * 
 * Returns update JSON queue  
 * 
 * POST '/enqueue' - put new student in the queue  
 * - advisorId - advisorId,  
 * - studentId - studentId,   
 * - reasonId - reasonId,  
 * - modalityId - modalityId,  
 * - customReason - (optional) custom reason
 * 
 * Returns JSON array containing all queues 
 */

  use Propel\Runtime\Exception\PropelException;

  const TIMEZONE = "America/New_York";
  const POSITION_NOT_NULL = "Visit.Position IS NOT NULL";
  const NO_ADVISOR_ID = "Missing an id of a advisor";

  /**
   * Make a single queue PHP object
   * @param Employee $advisor - advisor for whom the queue is 
   * @param object $visits - visits belonging in this queue
   * @return object - a PHP object containing fields:  
   * - advisorId - AdvisorId (QueueId)  
   * - advisorName - Name of the advisor
   * - pictureUrl - url of the image of the advisor (if given)  
   * - EstimatedEWaitTime - estimated wait time for this queue
   * - queue - contains array students in the queue 
   */
  function makeQueueObject(Employee $advisor, object $visits): object {
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

  /**
   * Moves the next student in the position 0 in the queue. 
   * Also updates invited_at time for this visit.
   * @param string $advisorId - queueId (advisorId)
   * @return object - returns updated queue fo an advisor
   * @throws PropelException
   * @throws Exception
   */
  function invite(string $advisorId): object
  {
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

  /**
   * Completes the visit for the student who is currently at the advisors
   * removes the student from the queue and updates complete_at time for this visit
   * @param string $advisorId - queueId (advisorId)
   * @return object - updated queue
   * @throws PropelException
   */
  function complete(string $advisorId):object {
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

  /**
   * Removes the student form the queue and updates completed_at timestamp for this visit.
   * @param string $studentId - studentId
   * @return object - updated queue
   * @throws PropelException
   */
  function cancel(string $studentId): object {
    $visit = VisitQuery::create()->where(POSITION_NOT_NULL)
                                 ->findOneByStudentId($studentId);
    if(!isset($visit)){
      returnUserError("$studentId was not found in any queues");
    }
    $advisorId = $visit->getAdvisorId();
    $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
    if (!isset($advisor)){
      returnServerError("Failed to find advisor with id $advisorId");
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

  /**
   * Moves student to the new position in the queue
   * @param int $position - new position
   * @param string $studentId - studentId
   * @param string $queueId - queueId (advisorId)
   * @return object - updated queue
   * @throws PropelException
   */
  function moveToPosition(int $position,
                          string$studentId,
                          string $queueId): object
  {
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

  /**
   * Put student in the queue
   * @param string $advisorId - advisorId (queueId)
   * @param string $studentId - studentId
   * @param int $modalityId - modalityId from the modality table
   * @param int $reasonId - reasonId from the reason table
   * @param string|null $customReason - (optional) custom reason
   * @return array - array containing all queues
   * @throws PropelException
   */
  function enqueue(string $advisorId,
                   string $studentId,
                   int $modalityId,
                   int $reasonId,
                   string $customReason = null): array
  {
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

  /**
   * Check if adviser is scheduled to accept walkins
   * @param string $advisorId - advisorId
   * @return bool
   */
  function checkCurrentAdvisor(string $advisorId): bool {
    $now = date("Y-m-d H:i:s");
    $hour = WalkinHourQuery::create()->
        filterByAdvisorId($advisorId)->
        filterByStartsAt(array('max' => $now))->
        filterByEndsAt(array('min' => $now))->
        findOne();
    return $hour !== null;
  } // checkCurrentAdvisor

  // queueId is an uid of advisor
  /**
   * Get a single queue by id
   * @param string $queueId - queueId (advisorId)
   * @return object - PHP object containing queue
   */
  function getQueue(string $queueId): object {
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

  /** Get all queues
   * @return array - contains all queues
   * @throws PropelException
   */
  function getAllQueues(): array {
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

  /**
   * Dispatch GET requests
   * @param array $pathComponents - Url path components
   * @throws PropelException
   */
  function processGetRoute(array $pathComponents): void {
    $queueId = array_shift($pathComponents);
    if (!$queueId) {
      returnResponse(getAllQueues());
    }
    returnResponse(getQueue($queueId));
  }

  /**
   * Dispatch POST requests
   * @param string $operation - name of operation requested
   * @throws PropelException
   */
  function processPostRoute(string $operation): void {
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
        $customReason = $_POST['customReason'] ?? null;
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