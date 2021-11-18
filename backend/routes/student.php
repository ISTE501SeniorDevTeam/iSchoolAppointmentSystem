<?php
/** 
 * @author Vladimir Martynenko  
 * 
 * Methods related to student table  
 * 
 * Requests for '/student' endpoint:  
 *
 * GET /ritid/{:ritid} - get student info from database or ldap
 * using 9 digit {:ritid}.    
 * 
 * Returns JSON containing fields:
 * - Uid - Uid of the student  
 * - Name - First and last name of the student  
 * - Ritid - RitId of the student  
 * - MajorId - student's major from major table  
 * - Major - name of the student's major  
 * - Grad - true if graduate major, or false if undergrad  
 * - AdvisorId - Uid if assigned advisor (default if there is no override per student)  
 * - AdvisorName - Name of the advisor  
 * - PictureUrl - Url of the picture of the advisor  
 * - IsGradAdvisor - True if grad advise, false if undergrad    
 *
 * 
 * GET /uid/{:uid} - get student info from the student table using {:uid}  
 * 
 * Returns same info JSON as above  
 * 
 * POST /updatemajor - update student's major in the database  
 * Body parameters:  
 * - studentId - (requires) Id of the student to update.  
 * - major - (required) ether major id from the major table or actual name of the major.   
 * 
 * Returns student record as JSON as above  
 * 
 * POST /updateadvisor - override advisor for the student  
 * Body parameters:  
 * - studentId - (required) Uid of the student to update  
 * - advisor - (required) Uid of the advisor to assign to student  
 * 
 * Returns same info JSON as above  
 *
 */

  use Propel\Runtime\Exception\PropelException;

  const STUDENT_NOT_FOUND = 'Student not found';

  /**
   * Get students record by RitId  
   * @param string $ritid - Ritid to search  
   * @param bool $force - request from ldap and avoid cache
   * @return object - a PHP object with student record
   * @throws PropelException
   */
  function getByRitid(string $ritid, bool $force=false): object{
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

  /**
   * Return student record from the student table of the database  
   * @param string $uid - uid of the student
   * @return object - a PHP object containing student record
   */
  function getByUid(string $uid): object{
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

  /**
   * Get default advisor for a given student
   * @param Student $student
   * @return Employee
   * @throws PropelException
   */
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

  /**
   * Convert propel student object to PHP object
   * @param Student $student
   * @return object
   * @throws PropelException
   */
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

  /**
   * Dispatch GET request
   * @param array $pathComponents
   * @throws PropelException
   */
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

  /**
   * Update student's major
   * @param string $studentId
   * @param string $major
   * @throws PropelException
   */
  function updateMajor(string $studentId, string $major): void{
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

  /**
   * Override the advisor for the student 
   * @param string $studentId - Uid of the student 
   * @param string $advisorId - Uid of the advisor
   * @throws PropelException
   */
  function updateadvisor(string $studentId, string $advisorId): void {
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

  /**
   * Dispatch POST requests
   * @param $operation
   * @throws PropelException
   */
  // Operation names must all be lowercase operation name provided by user is converted to the lower case
  function processPostRoute($operation): void{
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