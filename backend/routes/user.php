<?php
/** @author Vladimir Martynenko */

  use Propel\Runtime\Exception\PropelException;

  const LOGIN_FAILED = 'Login failed';
  const CHANGE_PASSWORD_FAILED = 'Failed to change password';
  /** @var Path to a file containing private key to sign JWTs */
  const KEY_FILE_NAME = "file:///home/MAIN/vm3132/Sites/iscis/api/shibboleth.pem";

/**
 * Makes a PHP object suitable for conversion to JSON
 * @param Employee $user user to convert to object
 * @return object a PHP object to return to user after converting to JSON
 * @throws PropelException
 */
  function makeUser(Employee $user): object{
    $result = (object)[
      'Uid' => $user->getUid(),
      'Name' => $user->getName(),
      'RoleId' => $user->getRoleId(),
      'Role' => $user->getRole()->getName()
    ];
    $isGardAdvisor = $user->getIsGradAdvisor();
    if($isGardAdvisor !== null){
      $result->IsGradAdvisor = $isGardAdvisor;
    }
    $pictureUrl = $user->getPictureUrl();
    if ($pictureUrl !== null){
      $result->PictureUrl = $pictureUrl;
    }
    $firstLetter = $user->getFirstLetter();
    if ($firstLetter !== null) {
      $result->FirstLetter = $firstLetter;
    }
    $lastLetter = $user->getLastLetter();
    if($lastLetter !== null) {
      $result->LastLetter = $lastLetter;
    }
    return $result;
  } // makeUser

/**
 * Make a JWT for a given employee
 * @param Employee $user Propel user object
 * @return string JWT signed a key from file named in KEY_FILE_NAME constant.  
 * JWT contains fields:  
 * iss: (issuer) Url with path of the system  
 * iat: (issued at) current unix timestamp  
 * user_id: Uid of the user provided as a parameter of a function
 */
  function makeJWT(Employee $user): string{
    $private_key = openssl_pkey_get_private(KEY_FILE_NAME);
    if (!$private_key) {
      $error = openssl_error_string();
      returnServerError("Unable to read a key file $error");
    }
    $private_string = '';
    $res = openssl_pkey_export($private_key, $private_string);
    if (!$res) {
      returnServerError('Unable to read a key details');
    }
    $date = new DateTime();
    $timestamp = $date -> getTimestamp();
    $payload = array(
            "iss" => $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
            "iat" => $timestamp,
            "user_id" => $user->getUid(),
            "user_name" => $user->getName()
    );
    return Firebase\JWT\JWT::encode($payload, $private_string, 'RS256');
  } // makeJWT

/**
 * Checks password provided by the user against the hash in the database for a given user id.  
 * Sends a JSON containing ether JWT on success or error message to the client.
 * @param string $userId user id provided by the person trying to log in
 * @param string $password password provided by the user
 * @throws PropelException
 */
  function login(string $userId, string $password): void {
    $user = EmployeeQuery::create()->findOneByUid($userId);
    if(!$user){
      returnUserError(LOGIN_FAILED);
    }
    $hash = $user->getHash();
    if($hash === null){
      returnUserError(LOGIN_FAILED);
    }
    if(password_verify($password, $hash)){
      $result = (Object)[
        'Uid' => $user->getUid(),
        'Name' => $user->getName(),
        'RoleId' => $user->getRoleId(),
      ];
      $roleId = $user->getRoleId();
      $role = RoleQuery::create()->findOneById($roleId);
      $result->Role = $role->getName();
      $pictureUrl = $user->getPictureUrl();
      if($pictureUrl !== null){
        $result->pictureUrl = $pictureUrl;
      }
      $jwt = makeJWT($user);
      $token = new Token();
      $token->setEmployeeId($userId);
      $token->setToken($jwt);
      $token->save();
      $result->Jwt = $jwt;
      returnResponse($result);
    }else{
      returnUserError(LOGIN_FAILED);
    }
  } //login

/**
 * Change password for a given user with an old and a new passwords provided. To change users own password.
 * @param string $userId id of a user to change password of
 * @param string $oldPassword old password in clear text
 * @param string $newPassword new password in clear text
 */
  function changePassword(string $userId, string $oldPassword, string $newPassword): void{
    $user = EmployeeQuery::create()->findOneByUid($userId);
    if ($user === null){
      returnUserError("User with id %userId not found");
    }
    $hash = $user->getHash();
    if($hash === null){
      returnUserError(CHANGE_PASSWORD_FAILED);
    }
    if(password_verify($oldPassword, $hash)){
      $user->setHash(password_hash($newPassword, PASSWORD_DEFAULT));
      $user->save();
      returnResponse((object)['ChangePassword' => 'success']);
    }
    returnUserError(CHANGE_PASSWORD_FAILED);
  } // changePassword

/**
 * Change password for a given user without old the password and only new passwords provided. To be used by admin.
 * @param string $userId Id of a user whose password is being changed
 * @param string $newPassword New password in clear text
 */
  function resetPassword(string $userId, string $newPassword): void{
    $user = EmployeeQuery::create()->findOneByUid($userId);
    if ($user === null){
      returnUserError("User with id %userId not found");
    }
    $user->setHash(password_hash($newPassword, PASSWORD_DEFAULT));
    $user->save();
    returnResponse((object)['ChangePassword' => 'success']);
  } // resetPassword
  
  function newUser(): void
  {
    $user = new Employee();
    $user->setUid($_POST['userId']);
    $user->setName($_POST['name']);
    $roleId = $_POST['role_id'];
    $role = RoleQuery::create()->findOneById($roleId);
    if ($role === null) {
      returnUserError("Role with id $roleId not found");
    }
    $user->setRole($role);
    $password = $_POST['password'] ?? null;
    if ($password !== null) {
      $user->setHash(password_hash($password, PASSWORD_DEFAULT));
    }
    $pictureUrl = $_POST['picture_url'] ?? null;
    if ($pictureUrl !== null) {
      $user->setPictureUrl($pictureUrl);
    }
    if ($role->getName() === 'Advisor') {
      $isGradAdvisor = $_POST['is_grad_advisor'] ?? null;
      if ($isGradAdvisor === null) {
        returnUserError('is_grad_advisor must be set for user with a role of Advisor');
      }
      if (strtolower($isGradAdvisor) === 'true') {
        $user->setIsGradAdvisor(true);
      }
      if (strtolower($isGradAdvisor) === 'false') {
        $user->setIsGradAdvisor(false);
      }
      $firstLetter = $_POST['first_letter'] ?? null;
      $lastLetter = $_POST['last_letter'] ?? null;
      if ($firstLetter === null || $lastLetter === null) {
        returnUserError('First and last letters must be set for advisors');
      }
      if (strcmp($firstLetter, $lastLetter) >= 0){
        returnUserError('First letters must be before last letter');
      }
      $user->setFirstLetter($firstLetter);
      $user->setLastLetter($lastLetter);
    }
    $user->save();
    returnResponse(makeUser($user));
  } // newUser

/**
 * Dispatch GET request to appropriate functions in this file
 * @param string[] $pathComponents components of the request path
 * @param string[] $requestParameters url parsed parameters
 */
  function processGetRoute(array $pathComponents, array $requestParameters): void{
    returnUserError('There are no endpoints for GET method');
  } // processGetRoute

/**
 * Dispatch POST request to appropriate functions in this file
 * @param string $operation name of the operation requested
 * @param string[] $pathComponents components of the request path
 * @param string[] $requestParameters url parsed parameters
 * @throws PropelException
 */
  function processPostRoute(string $operation, array $pathComponents, array $requestParameters): void{
    switch ($operation) {
      case 'login':
        if (!isset($_POST['userId'])){
          returnUserError("Missing user id.");
        }
        if (!isset($_POST['password'])){
          returnUserError("Missing password");
        }
        login($_POST['userId'], $_POST['password']);
        break;
      case 'changepassword':
        if (!isset($_POST['userId'])){
          returnUserError("Missing user id.");
        }
        if (!isset($_POST['old_password'])){
          returnUserError("Missing old password");
        }
        if (!isset($_POST['new_password'])){
          returnUserError("Missing new password");
        }
        changePassword($_POST['userId'], $_POST['old_password'], $_POST['new_password']);
        break;
      case 'resetpassword':
        if (!isset($_POST['userId'])){
          returnUserError("Missing user id.");
        }
        if (!isset($_POST['password'])){
          returnUserError("Missing Password");
        }
        resetPassword($_POST['userId'], $_POST['password']);
        break;
      case 'newuser':
        if (!isset($_POST['userId'])){
          returnUserError("Missing user id.");
        }
        if (!isset($_POST['name'])){
          returnUserError("Missing user's name");
        }
        if (!isset($_POST['role_id'])){
          returnUserError("Missing role id");
        }
        newUser();
        break;
      default:
        returnUserError("$operation is not a supported operation for queue endpoint.");
        break;
    }
  } // processPostRoute