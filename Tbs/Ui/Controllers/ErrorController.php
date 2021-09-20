<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Controllers;

class ErrorController extends PagebasicController
{
   public function index(int $errCode)
   {
      $data = [];

      $data['error_code']        = $errCode;
      $data['error_message']     = '';
      $data['error_actionLink']  = "/dashboard";
      $data['error_actionText']  = lang('Ui.returnToDashBoard');

      switch($errCode)
      {
         case 400:
         case 401:
            $data['error_message']     = lang('Ui.accessIsDenied'); 
            break;
         case 404:
            $data['error_message']     = lang('Ui.requestedUrlNotfound');
            break;
         case 500:
            $data['error_message']     = lang('Ui.internalServerError');
            break;
         default:
            $data['error_message']     = lang('Ui.erroOccured');
      }

      $title = $errCode . ' ' . lang('Ui.error') . ' ' . 'APP';

      // replace default layout with Error layout
      $layoutNamespace = $this->page->config()->layouts['error'];
      $this->page->layoutPath($layoutNamespace);
      
      $this->page->setId("page_error")
                 ->setTitle($title)
                 ->setContentTitle(lang('Ui.error'))
                 ->setview('Tbs\Ui\Views\Error\error')
                 ->setData($data);
   
      return $this->page->show();
   }
}
