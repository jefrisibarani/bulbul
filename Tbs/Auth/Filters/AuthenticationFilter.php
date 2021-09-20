<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\App;

class AuthenticationFilter implements FilterInterface
{
   /**
    * Verifies that a user is logged in, or redirects to login.
    *
    * @param RequestInterface $request
    * @param array|null $params
    *
    * @return mixed
    */
   public function before(RequestInterface $request, $params = null)
   {
      $current = (string)current_url(true)
         ->setHost('')
         ->setScheme('')
         ->stripQuery('token');

      $config = config(App::class);
      if($config->forceGlobalSecureRequests)
      {
         # Remove "https:/"
         $current = substr($current, 7);
      }

      // Make sure this isn't already a login route
      $ignoredPath = ['/index.php/login', '/index.php/register', '/index.php/forgotpassword'];
      
      if(in_array((string)$current, $ignoredPath)) {
         return;
      }

      //if (!session()->get('loggedIn')) 
      if (!service('authentication')->isLoggedIn()) 
      {
         session()->set('redirect_url', current_url());
         //return redirect('login');
         return redirect()->to(base_url('login'));
      }
   }

   public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
   {
   }
}
