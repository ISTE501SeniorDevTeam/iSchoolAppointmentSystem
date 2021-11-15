<?php
/** @author Vladimir Martynenko */

  function getQueue($queueId) {
    returnResponse((object)[]);
  }

  function sendAll(): array
  {
//    $result = [];
    $rows = VisitQuery::create()->
      select(['created_at', 'invited_at', 'complete_at', 'custom_reason'])->
      joinModality()->
      joinReason()->
      joinEmployee()->
      useStudentQuery()->
      withColumn('Student.name', 'student')->
        joinMajor()->
        withColumn('Major.name', 'major')->
        withColumn('Major.grad', 'graduate')->
      endUse()->
      withColumn('employee.name', 'advisor')->
      withColumn('modality.name', 'modality')->
      withColumn('reason.name', 'reason')->
      find();
    $csv = $rows->toCSV();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Length: ' . strlen($csv));
    die($csv);

//    foreach($rows as $row){
//      $result[] = (Object)$row;//->toArray();
//    }
    // var_dump($row);
//    return $result;
  }

  function processGetRoute($pathComponents, $requestParameters){
    $id = array_shift($pathComponents);
    if (!$id) {
      sendAll();
    }
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