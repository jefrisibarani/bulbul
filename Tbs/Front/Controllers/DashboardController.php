<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Front\Controllers;
use Tbs\Ui\Controllers\PageController;

class DashboardController extends PageController
{
   public function index()
   {
      // create Basic Page
      $this->page->setId("page_dashboard")
                 ->setTitle(lang('Front.dashboardTitle'))
                 ->setContentTitle(lang('Front.dashboardTitle'))
                 ->setview('Tbs\Front\Views\Dashboard\dashboard')
                 ->setLanguageGroup('Front');
   
      return $this->page->show();
   }
}
