<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Tbs\Ui\PageBasic;

class PagebasicController extends Controller
{
   protected $request;
   protected $helpers = ['Tbs\Ui\Helpers\ui',];
   protected PageBasic $page;

   public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
   {
      // Do Not Edit This Line
      parent::initController($request, $response, $logger);

      //--------------------------------------------------------------------
      // Preload any models, libraries, etc, here.
      //--------------------------------------------------------------------

      $this->setupPage();
   }

   private function setupPage()
   {
      $this->page = new \Tbs\Ui\PageBasic('main_page', lang('Front.pageTitle'));
      $this->page->setRequest($this->request);
      
      $auth = service("authentication");
      if( $auth->isLoggedIn())
      {
         $identity = $auth->identity();
         $this->page->setLanguage($identity->selectedLangId);
      }
      else
      {
         $config = config("\App\Config\App");
         $this->page->setLanguage($config->defaultLocale);
      }

      $config = config("\Tbs\Auth\Config\Auth");
   }
}
