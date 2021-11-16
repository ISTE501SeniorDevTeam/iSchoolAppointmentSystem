<?php
/** @author Vladimir Martynenko */

  use Propel\Runtime\Exception\PropelException;

  const FORMAT = 'Y-m-d H:i:s';
  const TZ = 'America/New_York';

/**
 * Convert propel object to PHP object ready to return as JSON
 * @param Ad $ad
 * @return object
 * @throws PropelException
 */
  function convertAd(Ad $ad): object {
    return (object)[
      'Id' => $ad->getId(),
      'Url' => $ad->getUrl(),
      'StartsAt' => $ad->getStartsAt() === null? null: $ad->getStartsAt()->format(FORMAT),
      'EndsAt' => $ad->getEndsAt() === null? null: $ad->getEndsAt()->format(FORMAT)
    ];
  } // convertAd

/**
 * Return a php object containing a record for an ad with the id provided
 * @param String $adId an id of ad to get 
 * @return object php object containing a record for an ad with the id provided
 * @throws PropelException
 */
function getAd(String $adId): object {
    $ad = AdQuery::create()->findOneById($adId);
    if($ad === null){
      returnUserError("Ad with id $adId not found");
    }
    return convertAd($ad);
  } // getAd

/** Get all ads in the database
 * @return array an array pf PHP objects containing all ar records in the database
 * @throws PropelException
 */
  function getAllAds(): array {
    $ads = AdQuery::create()->find();
    if($ads === null){
      returnServerError('No ads found');
    }
    $result = [];
    foreach($ads as $ad){
      $result[] = convertAd($ad);
    }
    return $result;
  } // getAllAds

/** Return ads that are scheduled to be displayed currently
 * @return array array of PHP objects containing ads scheduled to display currently
 * @throws PropelException
 */
  function getCurrentAds(): array {
    $now = date_create('now', new DateTimeZone(TZ));
    $ads = AdQuery::create()->
      filterByStartsAt(array('max' => $now))->
      _or()->filterByStartsAt(null)->
      filterByEndsAt(array('min' => $now))->
      _or()->filterByEndsAt(null)->
      find();
    if($ads === null){
      returnUserError('No current ads found');
    }
    $result = [];
    foreach($ads as $ad){
      $result[] = convertAd($ad);
    }
    return $result;
  } // getCurrentAds

/**
 * Create a new record in the database with values provided in the request body
 * @return object PHP object containing a new record with (including ID)
 * @throws PropelException
 */
  function createAd(): object {
    if(empty($_POST['url'])){
      returnUserError('Missing Url parameter');
    }
    $startsAt = $_POST['starts_at'] ?? null;
    $endsAt   = $_POST['ends_at'] ?? null;
    $tz = new DateTimeZone(TZ);
    if($startsAt !== null){
      $startsAt = date_create($startsAt, $tz);
      if ($startsAt === null){
        sendUserError('Failed to parse starts_at parameter');
      }
    }
    if($endsAt !== null){
      $endsAt = date_create($endsAt, $tz);
      if ($endsAt === null){
        sendUserError('Failed to parse ends_at parameter');
      }
    }
    if($startsAt !== null && $endsAt !== null && $startsAt > $endsAt){
      returnUserError('Starts_at date cannot be later than ends_at date');
    }
    $ad = new Ad();
    $ad->setId(Ramsey\Uuid\Uuid::uuid4());
    $ad->setUrl($_POST['url']);
    $ad->setStartsAt($startsAt);
    $ad->setEndsAt($endsAt);
    $ad->save();
    return convertAd($ad);
  } // createAd

/**  Processes update of starts_at field with new value in the body of the request
 * @param Ad $ad propel object containing the ad to update
 */
  function updateStartsAt(Ad $ad): void{
    $startsAt = $_POST['starts_at'] ?? null;
    if($startsAt !== null){
      if($startsAt === '' || $startsAt === 'false'){
        $ad->setStartsAt(null);
      } else {
        $startsAt = date_create($startsAt, new DateTimeZone(TZ));
        if ($startsAt === null){
          sendUserError('Failed to parse starts_at parameter');
        }
        $ad->setStartsAt($startsAt);
      }
    }
  } // updateStartsAt

/** Processes update of ends_at field with new value in the body of the request
 * @param Ad $ad propel object containing the ad to update 
 */
  function updateEndsAt(Ad $ad): void {
    $endsAt = $_POST['ends_at'] ?? null;
    if($endsAt !== null){
      if($endsAt === '' || $endsAt === 'false'){
        $ad->setEndsAt(null);
      } else {
        $endsAt = date_create($endsAt, new DateTimeZone(TZ));
        if ($endsAt === null){
          sendUserError('Failed to parse ends_at parameter');
        }
        $ad->setEndsAt($endsAt);
      }
    }
  } // updateEndsAt

/**
 * Update an ad with new values provided in the body of a request
 * @param string $adId ad id of an object being updated
 * @return object a PHP object containing an update ad record
 * @throws PropelException
 */
  function updateAd(string $adId): object {
    $ad = AdQuery::create()->findOneById($adId);
    if($ad === null){
      returnUserError("Ad with id $adId not found");
    }
    if(isset($_POST['url'])){
      $ad->setUrl($_POST['url']);
    }
    updateStartsAt($ad);
    updateEndsAt($ad);
    if($ad->getStartsAt() !== null && $ad->getEndsAt() !== null &&
       $ad->getStartsAt() > $ad->getEndsAt()){
      returnUserError('Starts_at date cannot be later than ends_at date');
    }
    $ad->save();
    return convertAd($ad);
  } // updateAd

/**
 * Delete an ad from the database
 * @param string $adId an id of an ad to delete 
 * @return object returns a number of records deleted as a PHP object
 * @throws PropelException
 */
function deleteAd(string $adId): object{
    $ad = AdQuery::create()->findOneById($adId);
    if($ad === null){
      return (Object)['Delete' => 0];
    }
    $ad->delete();
    return (Object)['Delete' => 1];
  } // deleteAd

/**
 * Dispatch a GET request to functions
 * @param array $pathComponents array containing elements of url path
 * @throws PropelException
 */
  function processGetRoute(array $pathComponents): void{
    $param = array_shift($pathComponents);
    if ($param === null) {
      returnResponse(getAllAds());
    }
    if ($param === 'current'){
      returnResponse(getCurrentAds());
    }
    returnResponse(getAd($param));
  } // processGetRoute

/**
 * Dispatches post request to functions
 * @param string $operation name of operation to perform
 * @param array $pathComponents array containing components of url path
 * @throws PropelException
 */
function processPostRoute(string $operation, array $pathComponents): void {
    if ($operation === 'create') {
      returnResponse(createAd());
    }
    $adId = array_shift($pathComponents);
    if($adId === null) {
      returnUserError('Missing ad id');
    }
    if($operation === 'update'){
      returnResponse(updateAd($adId));
    }
    if($operation === 'delete'){
      returnResponse(deleteAd($adId));
    }
    returnUserError("$operation is not a supported operation for ad endpoint");
  } // processPostRoute