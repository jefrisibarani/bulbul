<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Config;

use CodeIgniter\Config\BaseConfig;

class Ui extends BaseConfig
{
   public $appName            = 'Tobasa';
   public $appDomain          = 'example.com';
   
   public $theme              = 'light';
   public $layout             = 'vertical';
   
   /*
      Namespaced Views directory 
      Note: https://codeigniter.com/user_guide/outgoing/views.html#namespaced-views
   */
   public $viewPath           = 'Tbs\Ui\Views';
   public $layoutPath         = 'Tbs\Ui\Views\Layouts';
   public $layoutCommonPath   = 'Tbs\Ui\Views\LayoutsCommon';

   public $layouts = [
            'basic'        => 'Tbs\Ui\Views\Layouts\Basic',
            'horizontal'   => 'Tbs\Ui\Views\Layouts\Horizontal',
            'vertical'     => 'Tbs\Ui\Views\Layouts\Vertical',
            'error'        => 'Tbs\Ui\Views\Layouts\Error',
          ];
   
   public $themes = [
            'dark'   => 'dark',
            'light'  => 'light',
          ];
}
