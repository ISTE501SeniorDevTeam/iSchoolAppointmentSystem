<?php
/** @author Vladimir Martynenko */

  function getReasonById($reasonId): object{
    $reason = ReasonQuery::create()->findOneById($reasonId);
    if(!$reason) {
      returnUserError("Reason id not found");
    }
    return((object)[
      'id' => $reasonId,
      'name' => $reason->getName(),
      'isGrad' => $reason->getIsGrad()
    ]);
  } // getReason
  
  function getAllReasons(): array{
    $reasons = ReasonQuery::create()->
        orderByIsGrad()->
        orderById()->
        find();
    if(!$reasons) {
      returnServerError('No reasons found');
    }
    $result = [];
    foreach($reasons as $reason) {
      $result[] = (Object) [
        'id' => $reason->getId(),
        'name' => $reason->getName(),
        'isGrad' => $reason->getIsGrad()
      ];
    }
    return $result;
  } // getAllReasons

  function getReasonsByGrad($grad): array{
    $reasons = ReasonQuery::create()->
      filterByIsGrad($grad === 'grad')->
      find();
    if(!$reasons) {
      returnServerError("No $grad reasons found");
    }
    $result = [];
    foreach($reasons as $reason) {
      $result[] = (Object) [
        'id' => $reason->getId(),
        'name' => $reason->getName(),
        'isGrad' => $reason->getIsGrad()
      ];
    }
    return $result;
  } // getReasonsByGrad

  function processGetRoute($pathComponents){
    $param = array_shift($pathComponents);
    if ($param === null) {
      returnResponse(getAllReasons());
    }
    if (is_numeric($param)){
      returnResponse(getReasonById($param));
    }
    if($param === 'grad' || $param === 'undergrad') {
      returnResponse(getReasonsByGrad($param));
    }
    returnUserError("$param is not a supported parameter");
  }

  function processPostRoute($operation){
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