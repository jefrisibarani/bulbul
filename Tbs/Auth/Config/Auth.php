<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
   public $authenticator      = 'Tbs\Auth\Authentication\DefaultAuthenticator';
   public $authenticationRepo	= 'Tbs\Auth\Repositories\AuthenticationRepo';

   public $authorizator       = 'Tbs\Auth\Authentication\DefaultAuthorizator';
   public $authorizationRepo  = 'Tbs\Auth\Repositories\AuthorizationRepo';

   public $views = [
      'login'	  => 'Tbs\Auth\Views\login',
      'register' => 'Tbs\Auth\Views\register',
      'forgot'	  => 'Tbs\Auth\Views\forgot',
      'reset'	  => 'Tbs\Auth\Views\reset',
   ];

   public $validFields = [
      'email',
      'username',
   ];

   public $allowRegistration     = true;
   public $useRememberMe         = true;
   public $rememberMeTime        = 5 * DAY;
   public $silent                = false;
   public $minimumPasswordLength = 8;

   public $useSessionExpiration  = true;
   public $sessionExpirationTime = 20 * MINUTE;
}
