<?php
/** @author Vladimir Martynenko */

  const TIME_FORMAT = 'H:i';
  const DATE_FORMAT = 'Y-m-d';

  function makeHour($hour): object {
    $advisor = $hour->getAdvisor();
    $startTime = $hour->getStartTime()->forrmat(TIME_FORMAT);
    $endTime = $hour->getEndTime()->forrmat(TIME_FORMAT);
    $date = $hour->getDate();
    $recurring = $date === null;
    $result = (Object)[
      'Id' => $hour->getIOd(),
      'AdvisorId' => $advisor->getUid(),
      'Advisor' => $advisor->getName(),
      'StartTime' => $startTime,
      'EndTime' => $endTime,
      'Recurring' => $recurring
    ];
    if($recurring){
      $result->StartRecurrence -> $hour->getStartRecurrence();
      $result->EndRecurrence -> $hour->endRecurrence();
      $result->DayOfTheWeek -> $hour->getDayOfWeek();
    } else {
      $result->Date = $date->format(DATE_FORMAT);
    }
    return $result;
  } // makeHour()

  function getHour($hourId): object {
    $hour = HourQuery::create()->findOneById($hourId);
    if ($hour === null){
      returnUserError("Hour with id $hourId not found");
    }
    return makeHour($hour);
  } // getHour()
  
  function getAllHours() {

  } // getAllHours()

  function getAllHoursForAdvisor($advisorId){

  } // getAllHoursForAdvisor()

  function getCurrentAdvisors(){

  } // getCurrentAdvisors()

  function isCurrent($advisorId){

  } // isCurrent()

  function getRecurringAdvisors(){

  } // getRecurringAdvisors()

  function getHoursForDate($date){

  } // getHoursForDate()

  function getHoursForWeek($date){

  } // getHoursForWeek()

  function createRecurring(){

  } // createRecurring()

  function createSingle(){

  } // createSingle()

  function updateRecurring($hourId){

  } // updateRecurring()

  function updateSingle($hourId){

  } // updateSingle()

  function delete($hourId): object {
    $hour = HourQuery::create()->findOneById($hourId);
    if($hour === null){
      return (Object)['Delete' => 0];
    }
    try {
      $hour->delete();
    } catch (\Propel\Runtime\Exception\PropelException $e) {
      returnUserError("Failed to delete hour with id $hour->getId;");
    }
    return (Object)['Delete' => 1];
  } // delete

  function processGetRoute($pathComponents, $requestParameters){
    $id = array_shift($pathComponents);
    if (!$id) {
      returnResponse(getHours());
    }
    // if(!(in_array($id, $ids))) {
      // returnUserError("$queueId is not an id of an active queue");
    // }
    returnResponse(get($id));
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