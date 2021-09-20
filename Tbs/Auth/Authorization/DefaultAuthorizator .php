<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Authentication;
use Tbs\Auth\Repositories\AuthorizationRepoInterface;
use Tbs\Auth\Authorization\AuthorizatorInterface;

class DefaultAuthorizator implements AuthorizatorInterface 
{
   private AuthorizationRepoInterface $authRepo;
   private $loggedOn = false;
   private $identity = null;

   public function __construct()
   {
      $config         = config('Tbs\Auth\Config\Auth');
      $repoClass      = $config->authorizationRepo;
      $this->authRepo = new $repoClass();

      if(session()->get('loggedIn'))
      {
         $identity = session()->get('identity');
         
         if($identity)
         {
            $this->loggedOn = true;
            $this->identity = $identity;
         }
      }
   }
   
   public function canAccess($user, $menuId) : bool
   {
      return true;
   }

   public function hasPermission($user, $permission) : bool
   {
      return true;
   }

}