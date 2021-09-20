<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui;
use CodeIgniter\HTTP\IncomingRequest;
use Tbs\Ui\Interfaces\IViewContent;
use Tbs\Ui\Alert\Alert;
use Tbs\Ui\Config\Ui as PageConfig;

abstract class PageBase extends ViewContentBase
{
   protected PageConfig       $config;
   protected Alert            $alert;
   protected ?IncomingRequest $request       = null;
   protected ?IViewContent    $content       = null;
   protected ?string          $languageGroup = null;
   
   // Namespaced layout directory
   protected string           $layoutPath;
   
   protected string           $currentLayout;

   public function __construct(string $id, string $title, string $view='', string $section='')
   {
      parent::__construct($id, $title, $view, $section);

      $this->config                = config("Tbs\\Ui\\Config\\Ui");
      $this->alert                 = service('alert');

      $this->layoutPath();

      $this->data['page_id']           = $this->id;
      $this->data['page_title']        = $this->title;
      $this->data['page_contentTitle'] = '';
      $this->data['page_view']         = $this->view;
      $this->data['page_language']     = 'en';

      // set active theme
      $active                          = $this->config->theme;
      $theme                           = $this->config->themes[$active];
      $this->data['page_theme']        = $theme;
   }
   
   /*
      Get or set namespaced layout directory for this Page.
      Note: https://codeigniter.com/user_guide/outgoing/views.html#namespaced-views
      
      This method return layout folder location containing the layout file and its
      partials views.

      If parameter $namespace supplied, this method sets new layout directory for this Page.
      
      @param  ?string $namespace
      @return string 
   */
   abstract public function layoutPath(?string $namespacedPath=null) : string;

   abstract public function show();

   /*
      Set language translation group for looking up translation text by Url segment name.
      Example use in generating breadcrumb title
      @param The name of the file of the language file
   */
   public function setLanguageGroup(string $group)
   {
      $this->languageGroup = $group;
   }
   
   public function languageGroup() : ?string
   {
      if(is_null($this->languageGroup))
         return null;
      
      return $this->languageGroup . '.';
   }  

   public function setRequest(IncomingRequest $request)
   {
      $this->request = $request;
   }

   public function request() : ?IncomingRequest
   {
      return $this->request;
   }

   public function config() : PageConfig
   {
      return $this->config;
   }

   public function alert() : Alert
   {
      return $this->alert;
   }

   public function content() : IViewContent
   {
      return $this->content;
   }

   public function setId(string $id) : PageBase
   {
      $this->id = $id;
      $this->data['page_id'] = $id;
      return $this;
   }  

   public function setTitle(string $title) : PageBase
   {
      $this->title = $title;
      $this->data['page_title'] = $title;
      return $this;
   }

   public function setContentTitle(string $text) : PageBase
   {
      $this->data['page_contentTitle'] = $text;
      return $this;
   }

   public function setView(string $view) : PageBase
   {
      $this->view = $view;
      $this->data['page_view'] = $view;
      return $this;
   }

   public function setData(array $data=[]) : PageBase
   {
      $this->data = array_merge($this->data, $data);
      return $this;
   }  

   public function setLanguage(string $lang) : PageBase
   {
      $this->data['page_language'] = $lang;
      return $this;
   }

   public function setContent(string $id, string $title, string $view='', string $section='') : PageBase 
   {
      $content = new BasicContent($id, $title, $view, $section);
      $this->content = $content;
      return $this;
   }

   public function language() : string
   {
      return $this->data['page_language'];
   }  

   public function contentTitle() : string
   {
      return $this->data['page_contentTitle'];
   }

   ///////////////////////////////////////////////////////////////////////////////
   //                   layout's part folder lookup methods                     //
   ///////////////////////////////////////////////////////////////////////////////
   public function include(string $view) : string
   {
      return view($this->part($view));
   }

   public function includeCommon(string $view) : string
   {
      return view($this->partCommon($view));
   }

   public function partCommon(string $view) : string
   {
      $view   = $this->config->layoutCommonPath . "\\" . $view;
      return $view;
   }

   public function part(string $view) : string
   {
      $view = $this->layoutPath . "\\" . $view;
      return $view;
   }  

   public function layout(string $name='layout') : string
   {
      $layout = $this->part($name);
      $this->currentLayout = $layout;
      return $layout;
   }  

   public function currentLayout() : string
   {
      return $this->currentLayout;
   }

   public function viewHeader()
   {
      return $this->part('header');
   }

   public function viewMeta()
   {
      return $this->part('meta');
   }  

   public function viewFooter()
   {
      return $this->part('footer');
   }

   public function viewCssCore()
   {
      return $this->part('css_core');
   }

   public function viewCssTheme()
   {
      return $this->part('css_theme');
   }  

   public function viewJsCore()
   {
      return $this->partCommon('js_core');
   }

   public function viewJsTbs()
   {
      return $this->partCommon('js_tbs');
   }
   
   public function viewJsSite()
   {
      return $this->partCommon('js_site');
   }  

   public function viewJsAlert()
   {
      return $this->partCommon('js_alert');
   }  

   ///////////////////////////////////////////////////////////////////////////////
   //                   resources folder lookup methods                         //
   ///////////////////////////////////////////////////////////////////////////////

   public function dirCss()
   {
      $path   = base_url() . '/css/';
      return $path;
   }

   public function dirJs()
   {
      $path   = base_url() . '/js/';
      return $path;
   }

   public function dirImg()
   {
      $path   = base_url() . '/img/';
      return $path;
   }

   public function dirVendor()
   {
      $path   = base_url() . '/vendor/';
      return $path;
   }  

   public function dirCssTheme($config=null)
   {
      $active = $this->config->theme;
      $theme  = $this->config->themes[$active];
      $path   = base_url() . '/themes/' . $theme . '/css/';
      return $path;
   }

   public function dirJsTheme($config=null)
   {
      $active = $this->config->theme;
      $theme  = $this->config->themes[$active];
      $path   = base_url() . '/themes/' . $theme . '/js/';
      return $path;
   }

   public function dirImgTheme($config=null)
   {
      $active = $this->config->theme;
      $theme  = $this->config->themes[$active];
      $path   = base_url() . '/themes/' . $theme . '/img/';
      return $path;
   }

   public function dirVendorTheme()
   {
      $active = $this->config->theme;
      $theme  = $this->config->themes[$active];
      $path   = base_url() . '/themes/' . $theme . '/vendor/';
      return $path;
   }  

   public function controllerName()
   {
      $router           = service('router'); 
      $controllerName   = $router->controllerName(); 
      
      $tokens = explode('\\', $controllerName);
      $count  = count($tokens);

      if($tokens && $count>0)
      {
         $found  = $tokens[$count-1];
         $pos = strpos($found, 'Controller');
         if($pos !== false)
         {
            $realName = substr($found, 0, strlen($found)-strlen('Controller') );
            return $realName;
         }
         
         return null;
      }
   }  

}