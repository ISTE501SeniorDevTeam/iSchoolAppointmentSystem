<?php
/**
 * @author Vladimir Martynenko  
 *
 * Methods related to role table   
 * 
 * Requests for '/role' endpoint:  
 * 
 * GET /{:role} - get a role record by ether role id or role name  
 * 
 * Returns JSON containing 'id' and 'name' fields  
 */

  /** 
   * Get role record using ether roleId or roleName 
   * @param string $param an id or name of role
   * @return object PHP object containing role record
   */
  function getRole(string $param): object {
    if(is_numeric($param)){
      $role = RoleQuery::create()->findOneById($param);
    } else {
      $role = RoleQuery::create()->findOneByName($param);
    }
    if($role === null){
      returnUserError('Role not found');
    }
    return (object)[
      'id' => $role->getId(),
      'name' => $role->getName()
    ];
  }
  
/** 
 * Dispatch GET request to appropriate function 
 */
  function processGetRoute(array $pathComponents): void {
    $role = array_shift($pathComponents);
    if($role === null){
      returnUserError('Role is missing');
    }
    returnResponse(getRole($role));
  }

  /**
   * Return error message informing client that there are no POST routes
   */
  function processPostRoute(): void {
    returnUserError('There are no POST methods for role endpoint');
  }