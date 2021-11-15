<?php
/** @author Vladimir Martynenko */

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

  const INDEX = 'default';

  function returnImage($name) {
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

  function createImage($name): object {
    if($_FILES[INDEX]["error"] !== 0){
      global $phpFileUploadErrors;
      $errorCode = $_FILES[INDEX]["error"];
      $errorMessage = $phpFileUploadErrors[$errorCode];
      sendServerError("[$errorCode] $errorMessage");
    }
    if(!isset($name)){
      $name = $_FILES[INDEX]["name"];
    }
    $existing = ImageQuery::create()->findOneByName($name);
    if($existing !== null){
      returnUserError("Name $name already exist in the table");
    }
    $image = new Image();
    $image->setName($name);
    $image->setData(file_get_contents($_FILES[INDEX]['tmp_name']));
    $image->save();
    return (Object)['Name' => $image->getName()];
  } // createImage

  function updateImage($name): object {
    if($_FILES[INDEX]["error"] !== 0){
      global $phpFileUploadErrors;
      $errorCode = $_FILES[INDEX]["error"];
      $errorMessage = $phpFileUploadErrors[$errorCode];
      sendServerError("[$errorCode] $errorMessage");
    }
    if(!isset($name)){
      $name = $_FILES[INDEX]["name"];
    }
    $image = ImageQuery::create()->findOneByName($name);
    if($image === null){
      $image = new Image();
      $image->setName($name);
    } 
    $image->setData(file_get_contents($_FILES[INDEX]['tmp_name']));
    $image->save();
    return (Object)['Name' => $image->getName()];
  } // updateImage

  function deleteImage($name): object {
    $image = ImageQuery::create()->findOneByName($name);
    if($image === null){
      return (Object)['Delete' => 0];
    }
    $image->delete();
    return (Object)['Delete' => 1];
  } // deleteImage
  
  function processGetRoute($pathComponents){
    $prop = array_shift($pathComponents);
    if (!$prop) {
      returnUserError('Missing image name');
    }
    returnImage($prop);
  } // processGetRoute

  function processPostRoute($operation, $pathComponents){
    $name = array_shift($pathComponents);
    $fileSent = (null !== ($_FILES && $_FILES[INDEX]));
    if($operation === 'create') {
      if(!$fileSent){
        returnUserError('Missing contents of a file');
      }
      returnResponse(createImage($name));
    }

    if($operation === 'update') {
      if(!$fileSent){
        returnUserError('Missing contents of a file');
      }
      returnResponse(updateImage($name));
    }

    if($operation === 'delete') {
      if($name === null){
        returnUserError('Missing image name');
      }
      returnResponse(deleteImage($name));
    }
    returnUserError("$operation is not a supported operation for image endpoint.");
  } // processPostRoute