<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
   public static function alert($getShared = true)
   {
      if ($getShared) {
         return static::getSharedInstance('alert');
      }

      return new \Tbs\Ui\Alert\Alert();
   }
}
