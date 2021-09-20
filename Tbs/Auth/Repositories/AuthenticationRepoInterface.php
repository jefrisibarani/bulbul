<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Repositories;

interface AuthenticationRepoInterface
{

   /**
    * Log on to Rest Server
    * @param array $credentials
    * @return null|object Identity
    */
   public function login(array $credentials);
   
   /**
    * Get user Roles
    * @param int|string $user user id or user name
    * @return null|array of Roles object

      $roleObject = (object) [
            'id'       	=> 1,
            'name' 		=> 'Admin',
            'alias'     => 'Administrator',
            'enabled'   => true,
            'sysrole'   => true,
      ];
    */
   public function getRoles($user);

   /**
    * Get user by id or name
    * @param int|string $user
    * @return null|object Identity
    */
   public function getUser($user);
}