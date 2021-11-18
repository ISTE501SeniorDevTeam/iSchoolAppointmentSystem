<?php
/**
 * @author Vladimir Martynenko
 *
 * Methods related to statistics  
 *
 * Requests for '/stat' endpoint:   
 * 
 * GET '/' - Download all visits 
 */

  use Propel\Runtime\Exception\PropelException;

  /**
   * Returns a CSV file containing all visits
   * @return array
   * @throws PropelException
   */
  function sendAllStats(): array
  {
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
  }

  /**
   * Dispatch GET requests
   * @param array $pathComponents - path components of the request Url
   * @throws PropelException
   */
  function processGetRoute(array $pathComponents): void {
//    $id = array_shift($pathComponents);
//    if (!$id) {
      sendAllStats();
//    }
//    returnResponse(get($id));
  }

  /**
   * Inform user that there are no POST routes
   */
  function processPostRoute(): void{
    returnUserError('Stat endpoint does not have any POST methods');
  }