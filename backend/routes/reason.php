<?php
/**
 * @author Vladimir Martynenko  
 *
 * Methods related to reason table
 *  
 * Requests for '/reason' endpoint:  
 * 
 * GET '/' - get all reason records in the database  
 * 
 * Returns array of PHP objects containing reason records  
 * 
 * GET '/{:reasonId}' - get a single reason record by {:reasonId}  
 *  
 * Returns PHP object containing fields:  
 * - id - reasonId  
 * - name - reason name  
 * - isGrad - Grad or undergrad  
 * 
 * GET '/grad' or '/undergrad' - returns all grad or undergrad reasons  
 * 
 * Returns array of PHP objects containing reason records
 */

  /**
   * Get reason record by reason id
   * @param string $reasonId - id of reason for visit
   * @return object PHP object containing reason record
   */
  function getReasonById(string $reasonId): object{
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

  /**
   * Return all record from reason table
   * @return array
   */
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

  /**
   * Get all grad or all undergrad reasons
   * @param string $grad ether 'grad' or something else for undergrad
   * @return array containing all grad ar all undergrad records
   */
  function getReasonsByGrad(string $grad): array{
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

  /** 
   * Dispatch GET requests 
   */
  function processGetRoute(array $pathComponents): void {
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

  /**
   * Dispatch POST requests
   * @param string $operation name of operation requested
   */
  function processPostRoute(string $operation): void {
//    switch ($operation) {
//      case "create":
//        returnServerError("$operation NOT IMPLEMENTED");      
//        break;
//      case "update":
//        returnServerError("$operation NOT IMPLEMENTED");
//        break;
//      case "delete":
//        returnServerError("$operation NOT IMPLEMENTED");
//        break;
//      default:
        returnUserError("$operation is not a supported operation for queue endpoint.");
//        break;
//    }
  }