<?php
/** @author Vladimir Martynenko */

use Propel\Runtime\Exception\PropelException;

  const TIME_FORMAT = 'H:i';
  const DATE_FORMAT = 'Y-m-d';
  const TIMEZONE = 'America/New_York';

/**
 * Convert hour propel object to PHP object ready to return as JSON to client
 * @param Hour $hour a propel object
 * @return object PHP object containing Hour record 
 * @throws PropelException
 */
  function makeHour(Hour $hour): object {
    $advisor = $hour->getEmployee();
    $startTime = $hour->getStartTime()->format(TIME_FORMAT);
    $endTime = $hour->getEndTime()->format(TIME_FORMAT);
    $date = $hour->getDate();
    $recurring = $date === null;
    $result = (Object)[
      'Id' => $hour->getId(),
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

/**
 * Retrieve a single hour object by id
 * @param string $hourId an id of an hour object 
 * @return object PHP object containing Hour record
 * @throws PropelException
 */
  function getHour(string $hourId): object {
    $hour = HourQuery::create()->findOneById($hourId);
    if ($hour === null){
      returnUserError("Hour with id $hourId not found");
    }
    return makeHour($hour);
  } // getHour()

/** Get all the hour objects in the database
 * @return array array containing PHP objects for all hour records 
 * @throws PropelException
 */
  function getAllHours(): array {
    $hours = HourQuery::create()->find();
    if ($hours === null) {
      returnServerError('Missing schedule table in the database');
    }
    $result = [];
    foreach ($hours as $hour){
      $result[] = makeHour($hour);
    }
    return $result;
  } // getAllHours()

/** Get all hours for advisor
 * @param string $advisorId Uid of an advisor
 * @return array array of PHP objects containing all records for the specified advisor
 * @throws PropelException
 */
  function getAllHoursForAdvisor(string $advisorId): array {
    $hours = HourQuery::create()->findByAdvisorId($advisorId);
    $result = [];
    foreach ($hours as $hour){
      $result[] = makeHour($hour);
    }
    return $result;
  } // getAllHoursForAdvisor()

/** Returns advisors currently accepting walkins
 * @return array array containing PHP objects with advisor records
 * @throws PropelException
 */
  function getCurrentAdvisors(): array {
    $advisors = EmployeeQuery::create()->where('is_grad_advisor IS NOT null')->find();
    $result = [];
    foreach ($advisors as $advisor){
      if (isCurrent($advisor->getUid())){
        $result[] = makeAdvisorJson($advisor);
      }
    }
    return $result;
  } // getCurrentAdvisors()

/**
 * Check if advisor is accepting walkins currently
 * @param string $advisorId
 * @return bool
 * @throws PropelException
 */
  function isCurrent(string $advisorId): bool {
    $timezone = new DateTimeZone(TIMEZONE);
    $time = date_create(date_create('now', $timezone)->format('H:i'), $timezone);
    $today = date_create('now', $timezone)->setTime(0, 0);
    $dayOfTheWeek = $today->format('w');
    $hours = HourQuery::create()->
      filterByAdvisorId($advisorId)->
      findByDate($today);
    if ($hours === null) {
      $hours = HourQuery::create()->
        filterByAdvisorId($advisorId)->
        findByDayOfWeek($dayOfTheWeek);
    }
    foreach($hours as $hour){
      if($hour->getStartTime() < $time && $hour->getEndTime() > $time){
        return true;
      }
    }
    return false;
  } // isCurrent()

//  function getRecurringAdvisors(){
//
//  } // getRecurringAdvisors()
//
//  function getHoursForDate($date){
//
//  } // getHoursForDate()
//
//  function getHoursForWeek($date){
//
//  } // getHoursForWeek()

/** Save a recurrent hour in the database 
 * @param string $advisorId Uid of an advisor 
 * @return object PHP object containing newly created hour record
 * @throws PropelException
 */
  function createRecurring(string $advisorId): object {
    $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
    if($advisor === null){
      returnUserError('Advisor not found');
    }
    $hour = new Hour();
    $hour->setEmployee($advisor);
    $startTime = $_POST['start_time'] ?? null;
    $endTime = $_POST['end_time'] ?? null;
    if($startTime === null){
      returnUserError('Missing start time');
    }
    $timezone = new DateTimeZone(TIMEZONE);
    $startTime = date_create($startTime, $timezone);
    $hour->setStartTime($startTime);
    if($endTime === null){
      returnUserError('Missing end time');
    }
    $endTime = date_create($endTime, $timezone);
    $hour->setEndTime($endTime);
    $dayOfTheWeek = $_POST['day_of_week'] ?? null;
    if($dayOfTheWeek === null){
      returnUserError('Missing day of the week for recurring hour');
    }
    $hour->setDayOfWeek($dayOfTheWeek);
    $starrRecurrence = $_POST['start_recurrence'] ?? null;
    if($starrRecurrence !== null){
      $starrRecurrence = date_create($starrRecurrence, $timezone);
      $hour->setStartRecurrence($starrRecurrence);
    }
    $endRecurrence = $_POST['end_recurrence'] ?? null;
    if ($endRecurrence !== null){
      $endRecurrence = date_create($endRecurrence, $timezone);
      $hour->setEndRecurrence($endRecurrence);
    }
    $hour->save();
    return makeHour($hour);
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
    } catch (PropelException $e) {
      returnUserError("Failed to delete hour");
    }
    return (Object)['Delete' => 1];
  } // delete

/**
 * Dispatch GET request to appropriate function
 * @param array $pathComponents Url path elements
 * @throws PropelException
 */
  function processGetRoute(array $pathComponents): void{
    $prop = array_shift($pathComponents);
    if ($prop === 'advisor'){
      $advisorId = array_shift($pathComponents);
      if($advisorId === null){
        returnUserError('Missing an id for advisor');
      }
      getAllHoursForAdvisor($advisorId);
    }
    if (!$prop) {
      returnResponse(getAllHours());
    }
    returnResponse(getHour($prop));
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