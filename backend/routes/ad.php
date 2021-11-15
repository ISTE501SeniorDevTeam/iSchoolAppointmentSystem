<?php
/** @author Vladimir Martynenko */
  const FORMAT = 'Y-m-d H:i:s';
  const TZ = 'America/New_York';

  function convertAd(Ad $ad): object {
    return (object)[
      'Id' => $ad->getId(),
      'Url' => $ad->getUrl(),
      'StartsAt' => $ad->getStartsAt() === null? null: $ad->getStartsAt()->format(FORMAT),
      'EndsAt' => $ad->getEndsAt() === null? null: $ad->getEndsAt()->format(FORMAT)
    ];
  } // convertAd

  function getAd(String $adId): object {
    $ad = AdQuery::create()->findOneById($adId);
    if($ad === null){
      returnUserError("Ad with id $adId not found");
    }
    return convertAd($ad);
  } // getAd

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

  function createAd(): object {
    if(empty($_POST['url'])){
      returnUserError('Missing Url parameter');
    }
    $startsAt = isset($_POST['starts_at'])? $_POST['starts_at']: null;
    $endsAt   = isset($_POST['ends_at'])?   $_POST['ends_at']:   null;
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
  
  function updateStartsAt($ad): void{
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

  function updateEndsAt($ad): void {
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

  function deleteAd(string $adId): object{
    $ad = AdQuery::create()->findOneById($adId);
    if($ad === null){
      return (Object)['Delete' => 0];
    }
    $ad->delete();
    return (Object)['Delete' => 1];
  } // deleteAd

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