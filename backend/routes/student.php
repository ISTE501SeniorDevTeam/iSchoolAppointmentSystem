<?php
/** @author Vladimir Martynenko */

  const STUDENT_NOT_FOUND = 'Student not found';

  function getByRitid($ritid, $force=false): object{
    if (strlen($ritid) != 9) {
      returnUserError("Incorrect length of ritid");
    }
    if (!ctype_digit($ritid)) {
      returnUserError("The ritid must contain only numbers");
    }
    
    if(!$force) {
      $student = StudentQuery::create()->findOneByRitid($ritid);
      if(!empty($student)){
        return makeStudentJson($student);
      }
    }

    define("LDAP_SERVER", "ldaps://ldap.rit.edu");
    define("LDAP_USER_USERNAME", "ischoolcheckin");
    define("LDAP_DN", "ou=People,dc=rit,dc=edu");
    define("LDAP_USER_PASSWORD", "Iste501SeniorDev");
    $ldap_search = "(ritID=" . $ritid . ")";
    
    $ldap = @ldap_connect(LDAP_SERVER);
    if (!$ldap) {
      returnServerError("Could not connect to ldap server");
    }
    if (!@ldap_bind($ldap, "uid=" . LDAP_USER_USERNAME . "," . LDAP_DN, LDAP_USER_PASSWORD)) {
      returnServerError("Could not bind to ldap server");
    }
    if (!$search = @ldap_search($ldap, LDAP_DN, $ldap_search, ["uid", "cn"])) {
      returnServerError("Ldap search failed");
    }
    $entry = @ldap_get_entries($ldap, $search)[0] ?? null;
    if(!$entry){
      returnUserError(STUDENT_NOT_FOUND);
    }
    $entry = array_filter($entry, fn($key): bool => !is_numeric($key) && $key !== "count" && $key !== "dn", ARRAY_FILTER_USE_KEY);
    $entry = array_map(fn($array):string => $array[0], $entry);
    $student = new Student();
    $student->setRitid($ritid);
    $student->setUid($entry['uid']);
    $student->setName($entry['cn']);
    $student->save();
    return(makeStudentJson($student));
  } // getByRitid

  function getByUid($uid): object{
    $student = StudentQuery::create()->findOneByUid($uid);
    if (!$student) {
      returnUserError(STUDENT_NOT_FOUND);
    }
    return makeStudentJson($student);
  } // getByUid

  function inBetween($name, $from, $to): bool{
    return (strcasecmp($from, substr($name, 0, strlen($from))) <= 0) &&
           (strcasecmp($to, substr($name, 0, strlen($to))) >= 0);
  } // inBetween

  function getAdvisorForStudent(Student $student): Employee{
    $advisors = EmployeeQuery::create()->where('Employee.is_grad_advisor IS NOT NULL')
                             ->filterByIsGradAdvisor($student->getMajor()->getGrad())->find();
    $name = $student->getName();
    $namePartsArray = explode(' ', $name);
    $lastName = end($namePartsArray);
    foreach($advisors as $advisor){
      if(inBetween($lastName, $advisor->getFirstLetter(), $advisor->getLastLetter())){
        return $advisor;
      }
    }
  }

  function makeStudentJson(Student $student): object{
    $result = (Object)[
      'Uid' => $student->getUid(),
      'Name' => $student->getName(),
      'Ritid' => $student->getRitid()
    ];
    $majorId = $student->getMajorId();
    if($majorId !== null){
      $result->MajorId = $majorId;
      $major = MajorQuery::create()->findOneById($majorId);
      if(!$major){
        returnServerError("Major with id $majorId not found in the database");
      }
      $result->MajorName = $major->getName();
      $result->Grad = $major->getGrad();
      $advisorId = $student->getAdvisorId();
      if($advisorId === null) {
        $advisor = getAdvisorForStudent($student);
        if($advisor === null){ 
          $studentId = $student->getUid();
          returnServerError("Advisor for student $studentId not found");
         }
      } else {
        $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
        if(!$advisor){
          returnServerError("Advisor with id $advisorId not found");
        }
      }
      $result->AdvisorId = $advisor->getUid();
      $result->AdvisorName = $advisor->getName();
      $result->PictureUrl = $advisor->getPictureUrl();
      $result->IsGradAdvisor = $advisor->getIsGradAdvisor();
    }
    return $result;
  } // makeStudentJson

  function processGetRoute(array $pathComponents): void{
    $field = array_shift($pathComponents);
    if (!$field) {
      returnUserError("Missing field name to search by.");
    }
    $value = array_shift($pathComponents);
    if (!$value) {
      returnUserError("Missing value to search for.");
    }
    switch ($field) {
      case "ritid":
        returnResponse(getByRitid($value));
        break;
      case "uid":
        returnResponse(getByUid($value));
        break;
      default:
        returnUserError("Searching by $field is not yet implemented.");
        break;
    }
  }

  function updateMajor(Student $studentId, Major $major): void{
    if (is_numeric($major)) {
      $majorObj = MajorQuery::create()->findOneById($major);
    } else {
      $majorObj = MajorQuery::create()->findOneByName($major);
    }
    if ($majorObj === null) {
      returnUserError('Major not found.');
    }
    $student = StudentQuery::create()->findOneByUid($studentId);
    if(!$student){
      returnUserError(STUDENT_NOT_FOUND);
    }
    $student->setMajorId($majorObj->getId());
    $student->save();
    $student->Major = $majorObj->getName();
    $result = (Object)[
      'Uid'=>$student->getUid(),
      'Ritid'=>$student->getRitid(),
      'Name'=>$student->getName(),
      'MajorId'=>$student->getMajorId(),
      'Major'=>$majorObj->getName()];
    if ($student->getAdvisorId() !== null) {
      $result->AdvisorId = $student->getAdvisorId();
      $result->Advisor = $student->getEmployee()->getName();
    }
    returnResponse($result);
  } // updateMajor

  function updateadvisor(Student $studentId, Employee $advisorId){
    $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
    if ($advisor === null) {
      returnUserError('Advisor not found.');
    }
    $student = StudentQuery::create()->findOneByUid($studentId);
    if(!$student){
      returnUserError(STUDENT_NOT_FOUND);
    }
    $student->setAdvisorId($advisor->getUid());
    $student->save();
    $result = (Object)[
      'Uid'=>$student->getUid(),
      'Ritid'=>$student->getRitid(),
      'Name'=>$student->getName(),
      'AdvisorId'=>$student->getAdvisorId(),
      'Advisor'=>$advisor->getName()];
    if($student->getMajorId()){
      $result->MajorId = $student->getMajorId();
      $result->Major = $student->getMajor()->getName();
    }
    returnResponse($result);
  } // updateadvisor

  // Operation names must all be lowercase operation name provided by user is converted to the lower case
  function processPostRoute($operation,): void{
    switch ($operation) {
      case 'updatemajor':
        if (!isset($_POST['studentId'])){
          returnUserError("Missing student id.");
        }
        if (!isset($_POST['major'])){
          returnUserError("Missing new major");
        }
        updateMajor($_POST['studentId'], $_POST['major']);
        break;
      case 'updateadvisor':
        if (!isset($_POST['studentId'])){
          returnUserError("Missing student id.");
        }
        if (!isset($_POST['advisor'])){
          returnUserError("Missing new advisor");
        }
        updateAdvisor($_POST['studentId'], $_POST['advisor']);
        break;
      default:
        returnUserError("$operation is not a supported operation for student endpoint.");
        break;
    }
  }