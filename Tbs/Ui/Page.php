<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui;
use Tbs\Ui\Form;
use Tbs\Ui\Breadcrumb\Breadcrumb;
use Tbs\Ui\Toolbar\Toolbar;

class Page extends PageBase
{
   protected ?Toolbar      $toolbar    = null;
   protected ?Breadcrumb   $breadcrumb = null;

   public function __construct(string $id, string $title, string $view='', string $section='')
   {
      parent::__construct($id, $title, $view, $section);

      $this->data['page_sessionExpNotice'] = true;
      $this->data['page_sessionTimeout']   = 20 * MINUTE;
   }

   public function layoutPath(?string $namespacedPath=null) : string
   {
      if (empty($namespacedPath))
      {
         // get active layout
         $active              = $this->config->layout;
         $this->layoutPath    = $this->config->layouts[$active];
      }
      else
      {
         $this->layoutPath = $namespacedPath;
      }

      return $this->layoutPath;
   }  


   public function show()
   {
      // create viewData array to be passed to rendered view
      $viewData = $this->data();
      // add Page object as a member of viewData
      $viewData['page'] = $this;

      // Make sure Page has a content, if not, create a basic content
      if( is_null($this->content))
      {
         if( !empty($this->view()) )
         {
            // Page doesn't have content, but has a view template
            // create BasicContent for this Page
            $this->setContent("content_basic", "", $this->view(), '');
         }
         else
         {
            // no content and no view template,
            // load empty view, with warning message maybe?
            $this->setContent("content_basic", "", 'Tbs\Ui\Views\empty', '');
         }
      }

      // we have content. process it now!
      // content must implement interface IViewContent
      // BasicContent and Form are derived from ViewContentBase, which implement IViewContent

      // add content object as member of viewData, use content's id as the key
      $contentId                 = $this->content->id();
      $viewData['page_content']  = $this->content;
      // merge data from content to viewData
      $viewData = array_merge($viewData, $this->content->data());

      if(!empty($this->content->title())) {
         $viewData['page_contentTitle']  = $this->content->title();
      }

      if($this->content instanceof Form ) 
      {
         $viewData['page_contentTitle']  = $viewData['form_title'];

         // Form, use content_form template
         $template = $this->partCommon('form');
      }
      else if($this->content instanceof BasicContent ) 
      {
         // Page, use content_page template
         $template = $this->partCommon('basic_content');
      }
      else 
      {
         // should never reach here
         // else, just use content's view template directly
         $template = $this->content->view();
      }
      
      // we have merged all view's data, set it back as this Page's data
      $this->data = $viewData;

      return view($template, $this->data);
   }  

   public function toolbar() : Toolbar
   {
      if(is_null($this->toolbar)) {
         $this->toolbar = new Toolbar($this, 'page_toolbar');
      }     

      return $this->toolbar;
   }

   public function breadcrumb() : Breadcrumb
   {
      if(is_null($this->breadcrumb))
      {
         $this->breadcrumb = new Breadcrumb($this, 'page_breadcrumb');
      }

      return $this->breadcrumb;
   }     

   public function setSessionTimeout(int $timeout) : Page
   {
      $this->data['page_sessionTimeout'] = $timeout;
      return $this;
   }

   public function setSessionExpNotice(bool $notice) : Page
   {
      $this->data['page_sessionExpNotice'] = $notice;
      return $this;
   }  

   public function setForm(string $id, string $title, string $view='', string $section='') : Form
   {
      $form = new Form($this, $id, $title, $view, $section);
      $this->content = $form;
      return $form;
   }

   public function viewSidebar()
   {
      return $this->part('sidebar');
   }

   public function viewHorizontalMenu()
   {
      return $this->part('horizontal_menu');
   }  
}