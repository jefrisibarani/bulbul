<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Config;

use CodeIgniter\Config\BaseService;
use Tbs\Auth\Authentication\AuthenticatorInterface;
use Tbs\Auth\Authorization\AuthorizatorInterface;

class Services extends BaseService
{
   public static function authentication(bool $getShared = true) : AuthenticatorInterface
   {
      if ($getShared) {
         return self::getSharedInstance('authentication'); 
      }

      $config = config('Tbs\Auth\Config\Auth');
      $class  = $config->authenticator;
      return new $class();
   }

   public static function authorization(bool $getShared = true) : AuthorizatorInterface
   {
      if ($getShared) {
         return self::getSharedInstance('authorization'); 
      }

      $config = config('Tbs\Auth\Config\Auth');
      $class  = $config->authorizator;
      return new $class();
   }	

}
