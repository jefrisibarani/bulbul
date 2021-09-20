<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Controllers;
use Tbs\Ui\Alert\Alert;
use Tbs\Ui\Controllers\PagebasicController;

class AuthController extends PagebasicController
{
   protected $auth;
   protected $config;
   protected $session;

   public function __construct()
   {
      $this->session = service('session');
      $this->config  = config('Tbs\Auth\Config\Auth');
      $this->auth    = \Tbs\Auth\Config\Services::authentication();
   }

   public function login()
   {
      if ($this->auth->isLoggedIn())
      {
         $redirectURL = session('redirect_url') ?? site_url('/');
         unset($_SESSION['redirect_url']);

         service('alert')->warning(lang('Auth.alreadyLoggedIn'), Alert::LOC_PAGE);
         return redirect()->to($redirectURL);
      }

        // Set a return URL if none is specified
      $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');
      
      $contentId = 'form_login';
      $this->page->setId($contentId)
                 ->setTitle(lang('Auth.loginTitle'))
                 ->setContent($contentId, lang('Auth.loginTitle'), $this->config->views['login']);
      
      return $this->page->show();
   }
   
   public function attemptLogin()
   {
      $rules = [
         'loginName' => 'required',
         'password' => 'required',
      ];

      /*
      if ($this->config->validFields == ['email'])
      {
         $rules['login'] .= '|valid_email';
      }
      */

      if (! $this->validate($rules)) {
         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
      }

      $authparam = [
         "userName"        => $this->request->getPost('loginName'), //$this->request->getVar('loginName')
         "password"        => $this->request->getPost('password'),  //$this->request->getVar('password')
         "selectedSiteId"  => $this->request->getPost('siteId')     ?: 1,
         "selectedLangId"  => $this->request->getPost('langId')     ?: 'en',
         "uniqueCode"      => $this->request->getPost('uniqueCode') ?: '',
      ];    

      $feedback = '';
      if( ! $this->auth->login($authparam, $feedback) )
      {
         service('alert')->warning($feedback ?? lang('Auth.badAttempt'), Alert::LOC_PAGE);
         return redirect()->back()->withInput();//->with('error', $feedback ?? lang('Auth.badAttempt'));
      }
   
      $identity = $this->auth->identity();
      
      $this->session->set('identity', $identity);
      $this->session->set('loggedIn', 1);
      
      $redirectURL = session('redirect_url') ?? site_url('/');
      unset($_SESSION['redirect_url']);

      $successMsg = $feedback ?? lang('Auth.loginSuccess');
      $successMsg = $identity->fullName. ", " . $successMsg;
      service('alert')->success($successMsg);

      return redirect()->to($redirectURL)->withCookies();//->with('message', lang('Auth.loginSuccess'));
   }
  
   public function logout()
   {
      if ($this->auth->isLoggedIn()) {
         $this->auth->logout();
      }

      return redirect()->to(site_url('/dashboard'));
   }
   
   public function forgotPassword()
   {
      $contentId = 'form_forgot_password';
      $this->page->setId($contentId)
                 ->setTitle(lang('Auth.forgotTitle'))
                 ->setContent($contentId, lang('Auth.forgotTitle'), $this->config->views['forgot']);

      return $this->page->show();
   }

   public function register()
   {
      $contentId = 'form_regiter_user';
      $this->page->setId($contentId)
                 ->setTitle(lang('Auth.register'))
                 ->setContent($contentId, lang('Auth.createAccount'), $this->config->views['register']);
      return $this->page->show();
   }  
}