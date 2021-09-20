<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Tbs\Ui\Page;

class PageController extends Controller
{
   protected $request;
   protected $helpers = ['Tbs\Ui\Helpers\ui',];
   protected Page $page;
   protected $auth;

   public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
   {
      // Do Not Edit This Line
      parent::initController($request, $response, $logger);

      //--------------------------------------------------------------------
      // Preload any models, libraries, etc, here.
      //--------------------------------------------------------------------
      $this->auth    = \Tbs\Auth\Config\Services::authentication();
      $this->setupPage();
   }

   private function setupPage()
   {
      $this->page = new \Tbs\Ui\Page('main_page', lang('Front.pageTitle'));
      $this->page->setRequest($this->request);
      
      $auth = service("authentication");
      if( $auth->isLoggedIn())
      {
         $identity = $auth->identity();
         $this->page->setLanguage($identity->selectedLangId);

         $data = $this->page->data();
         $data['page_identityFullName'] = $identity->fullName;
      }
      else
      {
         $config = config("\App\Config\App");
         $this->page->setLanguage($config->defaultLocale);
      }

      $config = config("\Tbs\Auth\Config\Auth");
      $this->page->setSessionTimeout(  $config->sessionExpirationTime);
      $this->page->setSessionExpNotice($config->useSessionExpiration);
   }
}
