<?php
/**
 * Entry point for all api requests
 */

use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;
use Propel\Runtime\Exception\PropelException;

if(empty($hit)){
  $hit = 1;
//   header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Origin", "*");
  header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  header("Access-Control-Allow-Methods: GET, POST");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
//  header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
//  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header("Pragma: no-cache");

  $endpoints = ['queue', 'role', 'student', 'user', 'reason', 'advisor', 'image', 'ad', 'stat', 'hour'];
  $basePathComponents = ["~vm3132", "iscis", "api"];

  require_once __DIR__ . '/vendor/autoload.php';
  require_once __DIR__ . '/generated-conf/config.php';


  $defaultLogger = new Logger('defaultLogger');
  $defaultLogger->pushHandler(new FirePHPHandler());
//  $serviceContainer->setLogger('defaultLogger', $defaultLogger);

  /**
   * Send a response to client as a JSON with specified response code.
   * @param object $object PHP object which will be returned tio a client as a JSON
   * @param int $code HTTP response status code to be returned to the client
   */
  function sendHttpResponse($object, int $code):void {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($code);
    die(json_encode($object, JSON_UNESCAPED_SLASHES));
  }

  /**
   * Send an error response as a JSON containing a message as value for 'error' key with a response code 400.
   * @param String $message Error description
   */
  function returnUserError(String $message): void {
    $responseObject = (object)[];
    $responseObject -> error = $message;
    sendHttpResponse($responseObject, 400);
  }

  /**
   * Send an error response as a JSON containing a message as value for 'error' key with a response code 500.
   * @param String $message Error description
   */
  function returnServerError(String $message): void {
    $responseObject = (object)[];
    $responseObject -> error = $message;
    sendHttpResponse($responseObject, 500);
  }

  /**
   * Send an error response as a JSON containing a message as value for 'error' key with a specified response code.
   * @param String $message
   * @param int $code
   */
  function returnError(String $message, int $code): void {
    $responseObject = (object)[];
    $responseObject -> error = $message;
    sendHttpResponse($responseObject, $code);
  }

  /**
   * Send a PHP object to a client as a JSON with response code 200.
   * @param Object $response Object to be sent
   */
  function returnResponse($response): void {
    sendHttpResponse($response, 200);
  }

  /**
   * Send a JSON string to a client with a response code 200.
   * @param String $json JSON string
   */
  function returnJsonResponse(String $json): void {
    header('Content-Type: application/json; charset=utf-8');
    die($json);
  }

  /**
   * Dispatch a GET request to an appropriate endpoint route file
   * @param String[] $pathComponents array containing components of request URL path
   * @param String[] $requestParameters array containing URL request parameters
   */
  function parseGet(array $pathComponents, array $requestParameters): void {
    global $endpoints;
    $endpointName = array_shift($pathComponents);
    if (!$endpointName) {
      returnUserError("Missing the name of the endpoint");
    }
    if (!(in_array($endpointName, $endpoints))){
      returnUserError("$endpointName is not a known endpoint");
    }
    if (!include_once("routes/$endpointName.php")) {
      returnServerError("Failed to load $endpointName route file.");
    } 
    processGetRoute($pathComponents, $requestParameters);
  }

  /** Dispatch a POST request to an appropriate endpoint route file with a name of requested operation
   * @param String[] $pathComponents array containing components of request URL path
   * @param String[] $requestParameters array containing URL request parameters
   * @throws PropelException
   */
  function parsePost(array $pathComponents, array $requestParameters): void {
    global $endpoints;
    $endpointName = array_shift($pathComponents);
    if (!$endpointName) {
      returnUserError("Missing the name of operation in POST request.");
    }
    if (!in_array($endpointName, $endpoints)){
      returnUserError("$endpointName is not a known endpoint");
    }
    if (!include_once("routes/$endpointName.php")) {
      returnServerError("Failed to load $endpointName route file.");
    } 
    $operation = array_shift($pathComponents);
    $operation = strtolower($operation);
    if (!$operation) {
      returnUserError("Missing the name of operation in POST request.");
    }
    processPostRoute($operation, $pathComponents, $requestParameters);
  }

  $requestUrl = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
  $requestPath = strtok($requestUrl, '?');
  $requestParametersString = strtok('?');
  $pathComponents = [];
  $component = strtok($requestPath, '/');
  while ($component !== false) {
    $pathComponents[] = $component;
    $component = strtok('/');
  }
  for ($i = 0; $i < count($basePathComponents); $i++) {
    if ($basePathComponents[$i] !== array_shift($pathComponents)) {
      returnServerError("Something went wrong while parsing the request.");
    }
  }
  $requestParameters = [];
  $parameter = strtok($requestParametersString, '&');
  while ($parameter !== false) {
    $requestParameters[] = $parameter;
    $parameter = strtok('&');
  }
  $requestMethod = $_SERVER['REQUEST_METHOD'];
  switch ($requestMethod) {
    case "GET":
      $defaultLogger->warning("Processing GET request");
      parseGet($pathComponents, $requestParameters);
      break;
    case "POST":
      parsePost($pathComponents, $requestParameters);
      break;
    default:
      returnUserError("$requestMethod is not a supported HTTP method");
    break;
  }
}