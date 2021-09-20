<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui;

class PageBasic extends PageBase
{
   public function __construct(string $id, string $title, string $view='', string $section='')
   {
      parent::__construct($id, $title, $view, $section);
   }

   public function layoutPath(?string $namespacedPath=null) : string
   {
      if (empty($namespacedPath))
         $this->layoutPath  = $this->config->layouts['basic'];
      else
         $this->layoutPath  = $namespacedPath;

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
      $viewData['page_content'] 	= $this->content;
      // merge data from content to viewData
      $viewData = array_merge($viewData, $this->content->data());
   
      if($this->content instanceof BasicContent ) 
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

      return view($template, $viewData);
   }
}