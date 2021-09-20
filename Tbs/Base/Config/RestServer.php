<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Base\Config;
use CodeIgniter\Config\BaseConfig;

class RestServer extends BaseConfig
{
   public $baseUrl = 'http://localhost:1620/';
   public $service = 'api';
   
   public $headerUserAgent          = 'TBSRestClient';
   public $headerContentType        = 'application/json';
   public $headerWebServiceVersion  = '100';
   public $headerClientAppId        = 'TOBASABULBUL';

   public $certOption               = [APPPATH . 'certificate.pem', 'mypassword'];
   public $verifySSL                = false;
   
   public function baseURI()
   {
      $baseURI = $this->baseUrl . $this->service . '/' ;
      return $baseURI;
   }
}
