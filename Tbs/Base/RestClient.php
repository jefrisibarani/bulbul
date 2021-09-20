<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Base;

use CodeIgniter\Exceptions\FrameworkException;

class RestClient
{
   protected $curlClient      = null;
   protected $error           = null;
   protected $serverMessage   = null;
   protected $result          = null;
   protected $serverResponse  = null;
   protected $config          = null;
   
   public function __construct()
   {
      $this->config = config('Tbs\Base\Config\RestServer');
      $this->curlClient = \Config\Services::curlrequest([
                           'baseURI' => $this->config->baseURI() ]);
   }

   public function getResult()
   {
      return $this->result;
   }

   public function getError()
   {
      return $this->error;
   }

   public function getMessage()
   {
      return $this->serverMessage;
   }

   public function getResponse()
   {
      return $this->serverMessage;
   }

   public function execute($requestType, $resource, $jsonData=null)
   {
      try 
      {
         if($requestType != 'GET') {
            $this->curlClient->setJSON($jsonData);
         }

         $this->serverResponse = 
            $this->curlClient->request(
               $requestType, 
               $resource, 
               [
                  'headers' => [
                     'User-Agent'            => $this->config->headerUserAgent,
                     'Content-Type'          => $this->config->headerContentType,
                     'X-webservice-version'  => $this->config->headerWebServiceVersion,
                     'X-client-app-id'       => $this->config->headerClientAppId
                  ],
                  'verify'       => $this->config->verifySSL,    // disable CURLOPT_SSL_VERIFYPEER
                  'cert'         => $this->config->certOption,
                  'http_errors'  => false,
                  'debug'        => true,
                  /*
                  'allow_redirects' => [
                     'max'       => 10,
                     'protocols' => ['https'] // Force HTTPS domains only.
                  ],
                  */                
               ]);

         $code   = $this->serverResponse->getStatusCode();    // 200
         //$reason = $response->getReason();          
         if ($code === 200) 
         {
            $resBody       = $this->serverResponse->getBody();
            $resData       = json_decode($resBody);
            $this->result  = $resData->result;
         }
         else
         {
            $result              = $this->serverResponse->getBody();
            $resutlData          = json_decode($result);
            $this->serverMessage = $resutlData->message;
            $this->error         = $this->serverResponse->getReason();
            return false;
         }
         
         return true;
      }
      catch (/*HTTPException*/FrameworkException $ex) 
      {
         $this->error = $ex->getMessage();
         return false;
      }
   }

   public function get($resource)
   {
      return $this->execute('GET', $resource, null);
   }

   public function post($resource, $jsonData=null)
   {
      return $this->execute('POST', $resource, $jsonData);
   }

   public function put($resource, $jsonData=null)
   {
      return $this->execute('PUT', $resource, $jsonData);
   }

   public function delete($resource, $jsonData=null)
   {
      return $this->execute('DELETE', $resource, $jsonData);
   }
}