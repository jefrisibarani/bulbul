<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Repositories;
use Tbs\Base\RestClient;

class AuthenticationRepo extends RestClient implements AuthenticationRepoInterface
{
   public function __construct()
   {
      parent::__construct();
   }  

   /**
    * Log on to Rest Server
    * @param array $credentials
    * @return null|object Identity
    */      
   public function login(array $credentials)
   {
      $resource = 'account/authenticate';
      /*
      $credentials = [
         "userName"        => '',
         "password"        => '',
         "selectedSiteId"  => 1,
         "selectedLangId"  => 'en',
         "uniqueCode"      => ''
      ];
      */
      
      if($this->post($resource, $credentials))
         return $this->getResult();
      else
         return null;
   }

   /**
    * Get user roles name
    * @param int|string $user user id or user name
    * @return null|object Role
    */
   public function getRoles($user)
   {
      $resource = 'account/user/roles/' .$user;

      if($this->get($resource))
         return $this->getResult();
      else
         return null;
   }

   /**
    * Get user by id or name
    * @param int|string $user
    * @return null|object Identity
    */   
   public function getUser($user)
   {
      $resource = 'account/user/' .$user;

      if($this->get($resource))
         return $this->getResult();
      else
         return null;
   }

   /**
    * Get user by id or name
    * @param int|string $user
    * @return null|object Identity
    */   
   public function getUsers()
   {
      $resource = 'users';
      
      $bearer = 'Bearer ';
      $auth = service("authentication");
      if( $auth->isLoggedIn())
      {
         $bearer .= $auth->Identity()->token;
      }
      
      $this->curlClient->setHeader('Authorization', $bearer);
      
      if($this->get($resource))
         return $this->getResult();
      else
         return null;
   }
}