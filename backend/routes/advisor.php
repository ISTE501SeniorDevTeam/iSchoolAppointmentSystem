<?php
/** @author Vladimir Martynenko */

  function checkCurrent($advisorId): bool {
    $now = date("Y-m-d H:i:s");
    $hour = WalkinHourQuery::create()->
        filterByAdvisorId($advisorId)->
        filterByStartsAt(array('max' => $now))->
        filterByEndsAt(array('min' => $now))->
        findOne();
    return $hour !== null;
    // var_dump($hour);
  } // checkCurrent

  function makeAdvisorJson($advisor): object {
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

  function getAdvisor($advisorId) {
    $advisor = EmployeeQuery::create()->
        where('Employee.is_grad_advisor IS NOT NULL')->
        findOneByUid($advisorId);
    if($advisor === null){
      returnUserError("Advisor with id $advisorId not found");
    }
    return makeAdvisorJson($advisor);
  } // getAdvisor
  
  function getAllAdvisors() {
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

  function getCurrentAdvisors() {
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

  function processGetRoute($pathComponents, $requestParameters){
    $param = array_shift($pathComponents);
    if (!$param) {
      returnResponse(getAllAdvisors());
    }
    if ($param === 'current') {
      returnResponse(getCurrentAdvisors());
    }
    returnResponse(getAdvisor($param));
  }

  function processPostRoute($operation, $pathComponents, $requestParameters){
    switch ($operation) {
      case "create":
        returnServerError("$operation NOT IMPLEMENTED");      
        break;
      case "update":
        returnServerError("$operation NOT IMPLEMENTED");
        break;
      case "delete":
        returnServerError("$operation NOT IMPLEMENTED");
        break;
      default:
        returnUserError("$operation is not a supported operation for queue endpoint.");
        break;
    }
  }