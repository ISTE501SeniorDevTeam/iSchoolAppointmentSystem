<?php
/** 
 * @author Vladimir Martynenko  
 * 
 * Due to restriction on proposed deployment platform (solace.ist.rit.edu)
 * I decided to store images of employees and ads in the database.
 *  
 * Requests for '/image' endpoint:
 * 
 * GET /{:name} - returns the file saved under :name
 * 
 * POST /create - saves files submitted as form-data file fields
 * returns a JSON array containing records files submitted.
 * Records contain filename  and ether 'success': 'ok' or 'error': error message 
 * 
 * POST /update - creates or updates files in the database.
 * returns a JSON array containing records files submitted.
 * Records contain filename  and ether 'success': 'ok' or 'error': error message
 * 
 * POST /delete/{:name} - deletes a file with :name from the database.
 * returns a JSON containing number of records deleted
 * 
 */

use Propel\Runtime\Exception\PropelException;

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
  );

/**
 * Retrieves an image from the database
 * @param string $name name of a requested image
 */
  function returnImage(string $name): void {
    $image = ImageQuery::create()->findOneByName($name);
    if($image === null){
      returnUserError("Image $name not found");
    }
    $data = $image->getData();
    $size = (fstat($data)['size']);
    $nameArray = explode('.', $name);
    $extension = strtolower(end($nameArray));
    header("content-type: image/$extension");
    header('Content-Length: ' . $size);
    echo stream_get_contents($data);
    exit();
  } // returnImage

/**
 * Creates a new image in the database
 * @return array array containing PHP object with 
 * name of a new image, error field for error and success=true
 * if uploaded successfully
 * @throws PropelException
 */
  function createImage(): array {
    global $phpFileUploadErrors;
    $result = [];
    foreach ($_FILES as $file) {
      $name = $file['name'];
      $status = (object)['name' => $name];
      $errorCode = $file['error'];
      if($errorCode !== 0){
        $errorMessage = $phpFileUploadErrors[$errorCode];
        $status->error = "[$errorCode] $errorMessage";
      } else {
        $existing = ImageQuery::create()->findOneByName($name);
        if($existing !== null){
          $status->error = "Name $name already exist in the table";
        } else {
          $image = new Image();
          $image->setName($name);
          $image->setData(file_get_contents($file['tmp_name']));
          $image->save();
          $status->success = true;
        }
      }
      $result[] = $status;
    }
    return $result;
  } // createImage

/**
 * Replaces content of an images with newly submitted files
 * @return array array of PHP objects containing 
 * the name of the image an ether 'error' or 'success' fields.
 * @throws PropelException
 */
  function updateImage(): array {
    global $phpFileUploadErrors;
    $result = [];
    foreach ($_FILES as $file) {
      $name = $file['name'];
      $status = (object)['name' => $name];
      $errorCode = $file['error'];
      if($errorCode !== 0){
        $errorMessage = $phpFileUploadErrors[$errorCode];
        $status->error = "[$errorCode] $errorMessage";
      } else {
        $image = ImageQuery::create()->findOneByName($name);
        if($image === null){
          $image = new Image();
          $image->setName($name);
        }
        $image->setData(file_get_contents($file['tmp_name']));
        $image->save();
        $status->success = true;
      }
      $result[] = $status;
    } // foreach
    return $result;
  } // updateImage

/**
 * Delete an image from the database
 * @param string $name Name of the image
 * @return object PHP object containing number of records deleted
 * @throws PropelException
 */
  function deleteImage(string $name): object {
    $image = ImageQuery::create()->findOneByName($name);
    if($image === null){
      return (Object)['Delete' => 0];
    }
    $image->delete();
    return (Object)['Delete' => 1];
  } // deleteImage

/**
 * Dispatch GET request
 * @param array $pathComponents array of elements of a URL path
 */
  function processGetRoute(array $pathComponents): void {
    $prop = array_shift($pathComponents);
    if (!$prop) {
      returnUserError('Missing image name');
    }
    returnImage($prop);
  } // processGetRoute

  /**
   * Dispatch POST request to an appropriate function
   * @param string $operation name of operation
   * @param array $pathComponents elements of URL path
   * @throws PropelException
   */
  function processPostRoute(string $operation, array $pathComponents): void {
    $name = array_shift($pathComponents);
    $sentFileCount = count($_FILES);
    if($operation === 'create') {
      if($sentFileCount === 0){
        returnUserError('Missing contents of a file');
      }
      returnResponse(createImage());
    }
    if($operation === 'update') {
      if($sentFileCount === 0){
        returnUserError('Missing contents of a file');
      }
      returnResponse(updateImage());
    }
    if($operation === 'delete') {
      if($name === null){
        returnUserError('Missing image name');
      }
      returnResponse(deleteImage($name));
    }
    returnUserError("$operation is not a supported operation for image endpoint.");
  } // processPostRoute