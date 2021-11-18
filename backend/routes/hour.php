<?php
/** 
 * @author Vladimir Martynenko  
 *
 * Methods related to walk in hours scheduling
 * 
 * Requests for '/hour' endpoint:  
 * 
 * GET '/' - get all hours records in the table  
 * 
 * Returns JSON array with all hour records in the table  
 * 
 * GET '/advisor/{:advisorId}' - get all hour records for {:advisorId}  
 * 
 * Returns JSON array containing records for requested advisor  
 * 
 * GET '/{:hourId}' - get a single hour record by id  
 * 
 * Returns JSON hour record with fields:  
 * - Id - hour record id,  
 * - AdvisorId - advisorId,  
 * - Advisor - Advisor name,  
 * - StartTime - start time of the period,  
 * - EndTime - end time of the period,
 * - Recurring - true / false,  
 * <b>For recurring:</b>  
 * - StartRecurrence - date after which recurrence begins or null,  
 * - EndRecurrence - date until which recurrence continues or null,
 * - DayOfTheWeek - number of the day of the week for the period,  
 * <b>For single day overrides:</b>  
 * - Date - a date on which this override takes place.  
 *
 * POST '/createsingle/{:advisorId}' - create a single day override  
 * Body parameters:  
 * - start_time - start time of the period,  
 * - end_time - end time of the period,  
 * - date - date for the override  
 * 
 * Returns a JSON with newly created hour record
 * 
 * POST '/createrecurring/{:advisorId}' - create a recurring hours record  
 * Body parameters:
 * - start_time - start time of the period,
 * - end_time - end time of the period,
 * - day_Of_week - day of the week,  
 * - start_recurrence - (optional) start recurrence date,  
 * - end_recurrence - (optional) end recurrence date  
 * 
 * Returns JSON with newly created record
 * 
 * POST '/updatesingle/{:hourId}' - update a single override record  
 * Body parameters:
 * - advisor_id - (optional) advisorId,  
 * - start_time - (optional) start time,  
 * - end_time - (optional) end time,  
 * - date - (optional) date  
 * 
 * Returns JSON with new event  
 * 
 * POST '/updaterecurring/{:hourId}' - Update recurring hour record  
 * Body parameters:
 * - advisor_id - (optional) advisorId,
 * - start_time - (optional) start time,
 * - end_time - (optional) end time,
 * - day_Of_week - (optional) day of the week,
 * - start_recurrence - (optional) start recurrence date,
 * - end_recurrence - (optional) end recurrence date  
 * 
 * Returns updated JSON record
 * 
 * POST '/delete/{:hourId}' - delete an hour record  
 * 
 * Returns JSON with number of records deleted
 */

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

/**
 * Create a record for a single day override 
 * @param string $advisorId id of an advisor
 * @return object PHP object containing newly created record
 * @throws PropelException
 */
  function createSingle(string $advisorId): object {
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
    $date = $_POST['date'] ?? null;
    if($date === null){
      returnUserError('Missing the date');
    }
    $date = date_create($date, $timezone);
    $hour->setDate($date);
    $hour->save();
    return makeHour($hour);
  } // createSingle()

/**
 * Update recurring hour
 * @param int $hourId id of an hour record to update
 * @return object PHP object containing updated hour record 
 * @throws PropelException
 */
  function updateRecurring(int $hourId): object {
    $hour = HourQuery::create()->findOneById($hourId);
    if($hour === null){
      returnUserError('Hour id not found');
    }
    $advisorId = $_POST['advisor_id'] ?? null;
    if($advisorId !== null){
      $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
      if($advisor === null){
        returnUserError('Advisor not found');
      }
      $hour->setEmployee($advisor);
    }
    $timezone = new DateTimeZone(TIMEZONE);
    $startTime = $_POST['start_time'] ?? null;
    if($startTime !== null){
      $startTime = date_create($startTime, $timezone);
      $hour->setStartTime($startTime);
    }
    $endTime = $_POST['end_time'] ?? null;
    if($endTime !== null){
      $endTime = date_create($endTime, $timezone);
      $hour->setEndTime($endTime);
    }
    $dayOfTheWeek = $_POST['day_of_week'] ?? null;
    if($dayOfTheWeek !== null){
      $hour->setDayOfWeek($dayOfTheWeek);
    }
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
  } // updateRecurring()

/** 
 * Update a single day hour record
 * @param int $hourId a hour id
 * @return object PHP object containing updated record 
 * @throws PropelException
 */
  function updateSingle(int $hourId): object {
    $hour = HourQuery::create()->findOneById($hourId);
    if($hour === null){
      returnUserError('Hour id not found');
    }
    $advisorId = $_POST['advisor_id'] ?? null;
    if($advisorId !== null){
      $advisor = EmployeeQuery::create()->findOneByUid($advisorId);
      if($advisor === null){
        returnUserError('Advisor not found');
      }
      $hour->setEmployee($advisor);
    }
    $timezone = new DateTimeZone(TIMEZONE);
    $startTime = $_POST['start_time'] ?? null;
    if($startTime !== null){
      $startTime = date_create($startTime, $timezone);
      $hour->setStartTime($startTime);
    }
    $endTime = $_POST['end_time'] ?? null;
    if($endTime !== null){
      $endTime = date_create($endTime, $timezone);
      $hour->setEndTime($endTime);
    }
    $date = $_POST['date'] ?? null;
    if ($date !== null){
      $date = date_create($date, $timezone);
      $hour->setDate($date);
    }
    $hour->save();
    return makeHour($hour);
  } // updateSingle()

/**
 * Delete a record for hour
 * @param string $hourId id of hour record to delete
 * @return object PHP object containing number of rows deleted
 */
  function deleteHour(string $hourId): object {
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

/**
 * Dispatch POST requests to appropriate functions
 * @param string $operation name of operation requested
 * @param array $pathComponents URL path elements
 * @throws PropelException
 */
  function processPostRoute(string $operation, array $pathComponents): void {
    $param = array_shift($pathComponents);
    switch ($operation) {
      case "createsingle":
        if ($param === null){
          returnUserError('Missing hour advisor id');
        }
        returnResponse(createSingle($param));      
        break;
      case 'createrecurring':
        if ($param === null){
          returnUserError('Missing hour advisor id');
        }
        returnResponse(createRecurring($param));
        break;
    }
    if ($param === null){
      returnUserError('Missing hour id');
    }
    switch ($operation) {
      case "updatesingle":
        returnResponse(updateSingle($param));
        break;
      case "updaterecurring":
        returnResponse(updateRecurring($param));
        break;
      case "delete":
        returnResponse(deleteHour($param));
        break;
      default:
        returnUserError("$operation is not a supported operation for queue endpoint.");
        break;
    }
  }