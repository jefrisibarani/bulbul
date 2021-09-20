<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Authentication;

use CodeIgniter\Events\Events;
use Tbs\Auth\Authentication\AuthenticatorInterface;
use Tbs\Auth\Repositories\AuthenticationRepoInterface;

class DefaultAuthenticator implements AuthenticatorInterface
{
   private AuthenticationRepoInterface $authRepo;
   private $loggedOn = false;
   private $identity = null;

   private $config;

   public function __construct()
   {
      $this->config   = config('Tbs\Auth\Config\Auth');

      $repoClass      = $this->config->authenticationRepo;
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

   public function login(array $credentials, &$feedback=null, bool $remember = false) : bool
   {
      if(empty($credentials)) 
      {
         $feedback = lang('Auth.invalidParameter');
         return false;
      }
   
      if (empty($credentials['userName']) OR empty($credentials['password'])) 
      {
         $feedback = lang('Auth.invalidParameter');
         return false;
      }

      $identity = $this->authRepo->login($credentials);
      if (!empty($identity))
      {
         $identity->fullName = $identity->firstName . ' ' . $identity->lastName;
         $this->identity = $identity;
         $this->loggedOn = true;

         $feedback = lang('Auth.loginSuccess');

         $this->setSessionExpirationCookie($identity);
         $this->setRememberMeCookie($identity);
         //$this->setIdentityCookie($identity);

         // trigger login event, in case anyone cares
         Events::trigger('login', $this->identity);
         return true;
      }
      else 
      {
         $feedback = $this->authRepo->getError();
         return false;
      }
   }

   public function isLoggedIn() : bool
   {
      return $this->loggedOn;
   }

   public function identity()
   {
      if($this->loggedOn)
         return $this->identity;
      else
         return null;
   }
   
   public function logout()
   {
      helper('cookie');

      // Destroy the session data - but ensure a session is still
      // available for flash messages, etc.
      if (isset($_SESSION))
      {
         foreach ($_SESSION as $key => $value)
         {
            $_SESSION[$key] = null;
            unset($_SESSION[$key]);
         }
      }

      // Regenerate the session ID for a touch of added safety.
      session()->regenerate(true);

      // Remove the cookie
      delete_cookie("remember_me");
      delete_cookie("session_expiration");

      if( $identity = $this->identity )
      {
         // Trigger logout event
         Events::trigger('logout', $identity);
         $this->identity = null;
      }

      return true;
   }

   public function setSessionExpirationCookie($identity)
   {
      if( !$this->config->useSessionExpiration) {
         return;
      }

      $selector  = bin2hex(random_bytes(12));
      $validator = bin2hex(random_bytes(20));
      $expires   = date('Y-m-d H:i:s', time() + $this->config->sessionExpirationTime);

      $token = $selector.':'.$validator;

      // Store it in the database
      //$this->loginModel->rememberUser($userID, $selector, hash('sha256', $validator), $expires);

      // Save it to the user's browser in a cookie.
      $appConfig = config('App');
      $response  = service('response');

      // Create the cookie
      $response->setCookie(
         'session_expiration',                     // Cookie Name
         $token,                                   // Value
         $this->config->sessionExpirationTime,     // # Seconds until it expires
         $appConfig->cookieDomain,
         $appConfig->cookiePath,
         $appConfig->cookiePrefix,
         $appConfig->cookieSecure,                 // Only send over HTTPS?
         false                                     // Hide from Javascript?
      );
   }

   public function setRememberMeCookie($identity)
   {
      if( !$this->config->useRememberMe) {
         return;
      }

      $selector  = bin2hex(random_bytes(12));
      $validator = bin2hex(random_bytes(20));
      $expires   = date('Y-m-d H:i:s', time() + $this->config->rememberMeTime);

      $token = $selector.':'.$validator;

      // Store it in the database
      //$this->loginModel->rememberUser($userID, $selector, hash('sha256', $validator), $expires);

      // Save it to the user's browser in a cookie.
      $appConfig = config('App');
      $response  = service('response');

      // Create the cookie
      $response->setCookie(
         'remember_me',                            // Cookie Name
         $token,                                   // Value
         $this->config->sessionExpirationTime,     // # Seconds until it expires
         $appConfig->cookieDomain,
         $appConfig->cookiePath,
         $appConfig->cookiePrefix,
         $appConfig->cookieSecure,                 // Only send over HTTPS?
         false                                     // Hide from Javascript?
      );
   }

   public function setIdentityCookie($identity)
   {
   }
   
}