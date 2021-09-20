<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Front\Config;
use CodeIgniter\Config\BaseConfig;

class Front extends BaseConfig
{
   public $viewPath = 'Tbs\Front\Views';

   public $views = [
      'dashboard'	=> 'Tbs\Front\Views\dashboard',
   ];
}
