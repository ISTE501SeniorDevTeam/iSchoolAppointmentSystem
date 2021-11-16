<?php
/** @author Vladimir Martynenko */

/**
 * Check if an advisor with given id is currently scheduled for walkins
 * @param string $advisorId uid of an advisor to check
 * @return bool returns true if advisor is scheduled to accept walkins
 */
  function checkCurrent(string $advisorId): bool {
    $now = date("Y-m-d H:i:s");
    $hour = WalkinHourQuery::create()->
        filterByAdvisorId($advisorId)->
        filterByStartsAt(array('max' => $now))->
        filterByEndsAt(array('min' => $now))->
        findOne();
    return $hour !== null;
  } // checkCurrent

/**
 * Convert propel object to a PHP object ready to return to client as JSON
 * @param Employee $advisor propel object to convert  
 * @return object converted object
 */
  function makeAdvisorJson(Employee $advisor): object {
    $result = [
      'AdvisorId' => $advisor->getUid(),
      'Name' => $advisor->getName(),
      'IsGrad' => $advisor->getIsGradAdvisor()
    ];
    $pictureUrl = $advisor->getPictureUrl();
    if ($pictureUrl !== null){
      $result['PictureUrl'] = $pictureUrl;
    }
    $firstLetter = $advisor->getFirstLetter();
    if ($firstLetter !== null) {
      $result['FirstLetter'] = $firstLetter;
    }
    $lastLetter = $advisor->getLastLetter();
    if($lastLetter !== null) {
      $result['LastLetter'] = $lastLetter;
    }
    $result['IsCurrent'] = checkCurrent($advisor->getUid());
    return (Object) $result;
  } // makeAdvisorJson

/**
 * Return an advisor by id
 * @param string $advisorId An id of advisor to locate
 * @return object PHP object containing record for an advisor
 */
  function getAdvisor(string $advisorId): object {
    $advisor = EmployeeQuery::create()->
        where('Employee.is_grad_advisor IS NOT NULL')->
        findOneByUid($advisorId);
    if($advisor === null){
      returnUserError("Advisor with id $advisorId not found");
    }
    return makeAdvisorJson($advisor);
  } // getAdvisor

/**
 * Return all advisors in the database
 * @return array|null array of PHP objects containing records for all advisors
 */
  function getAllAdvisors(): ?array {
    $advisors = EmployeeQuery::create()->
        where('Employee.is_grad_advisor IS NOT NULL')->
        find();
    if($advisors === null) {
      returnServerError('No advisors found');
    }
    $result = [];
    foreach ($advisors as $advisor){
      $result[] = makeAdvisorJson($advisor);
    }
    return $result;
  } // getAllAdvisors


/**
 * Get all advisors scheduled to accept walkins currently
 * @return array|null Array of PHP objects containing records for advisors
 */
  function getCurrentAdvisors(): ?array {
    $advisors = EmployeeQuery::create()->
        where('Employee.is_grad_advisor IS NOT NULL')->
        find();
    if($advisors === null) {
      returnServerError('No advisors found');
    }
    $result = [];
    foreach ($advisors as $advisor){
      $advisorJson = makeAdvisorJson($advisor);
      if($advisorJson->IsCurrent) {
        $result[] = $advisorJson;
      }
    }
    return $result;
  } // getCurrentAdvisors

/** Dispatch GET request to appropriate functions 
 * @param array $pathComponents array containing url path components 
 * @param array $requestParameters array containing request parameters
 */
  function processGetRoute(array $pathComponents, array $requestParameters): void {
    $param = array_shift($pathComponents);
    if (!$param) {
      returnResponse(getAllAdvisors());
    }
    if ($param === 'current') {
      returnResponse(getCurrentAdvisors());
    }
    returnResponse(getAdvisor($param));
  }

/**
 * Notifies client to use user endpoint to modify advisors
 * @param string $operation name of operation requested
 * @param array $pathComponents array containing url path components
 * @param array $requestParameters array containing request parameters
 */
  function processPostRoute(string $operation, array $pathComponents, array $requestParameters): void {
    returnUserError("$operation is not a supported operation for advisor endpoint (use user endpoint) .");
  }