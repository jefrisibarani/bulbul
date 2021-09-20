<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Breadcrumb;

use Tbs\Ui\PageBase;
use Tbs\Ui\ViewContentBase;
use Tbs\Ui\Interfaces\IBreadcrumb;

class Breadcrumb extends ViewContentBase implements IBreadcrumb
{
   protected PageBase $page;
   
   public function __construct(PageBase $page, $id)
   {
      parent::__construct($id, '', '', '');
      
      $this->page = $page;
      $this->config   = config("Tbs\\Ui\\Config\\Ui");

      $this->data['breadcrumb_id']        = $this->id;
      $this->data['breadcrumb_title']     = $this->title;
      $this->data['breadcrumb_view']      = $this->view;
      $this->data['breadcrumb_section']   = $this->section;
   }

   public function html() : string
   {
      //if($this->page->content() instanceof \Tbs\UI\BasicContent ) {
      //}
      //else if($this->page->content() instanceof \Tbs\Ui\Form ) {
      //}
      
      $request  = $this->page->request();
      $segments = $request->getUri()->getSegments();
      
      $html     = '';
      $html    .= '<ol id="'.$this->id.'" class="breadcrumb mb-2">';
      $crumbLink = '/' ;

      $html .= '<li class="breadcrumb-item"><a href="'. base_url().'">'. lang('Ui.homepage') .'</a> </li>';
      
      // Get language group name, to be used with lang() to resolve correct crumb title
      // url mapping of segment name and title must be prepared in Language file inside Language folder
      // When no language group found from Page, use controller name as language file name
      $languageGroup    = $this->page->languageGroup();
      if(is_null($languageGroup)) {
         $languageGroup = $this->page->controllerName() . '.'; // so we can use lang('Examples.name')
      }

      $segmentCount   = count($segments);

      for($i=0; $i<$segmentCount; $i++) 
      {
         $crumbLink .= $segments[$i] . '/';
         $segment    = $segments[$i];

         // find correct translation
         $crumbTitle = lang($languageGroup.$segment);
         
         if($i==($segmentCount-1)) {
            $html .= '<li class="breadcrumb-item active">' .$crumbTitle. '</li>';
         }
         else
         {
            $html .= '<li class="breadcrumb-item"><a href="'. base_url().$crumbLink .'">'.$crumbTitle.'</a> </li>';
         }
      }

      $html .= '</ol>';

      return $html;
   }
}