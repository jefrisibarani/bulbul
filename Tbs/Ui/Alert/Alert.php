<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Alert;

class Alert
{
   const LOC_PAGE    = 'Page';
   const LOC_FORM    = 'Form';
   const LOC_TOAST   = 'Toast';
   const TYP_SUCCESS = 'alert-success';
   const TYP_INFO		= 'alert-info';
   const TYP_WARNING = 'alert-warning';	
   const TYP_ERROR	= 'alert-danger';	
   
   public function __construct()
   {
   }
   
   function success($message, $location=Alert::LOC_TOAST, $autoClose=TRUE)
   {
      $this->addAlert(Alert::TYP_SUCCESS, $message, $location, $autoClose);
   }

   function info($message, $location=Alert::LOC_TOAST, $autoClose=TRUE)
   {
      $this->addAlert(Alert::TYP_INFO, $message, $location, $autoClose);
   }

   function warning($message, $location=Alert::LOC_TOAST, $autoClose=TRUE)
   {
      $this->addAlert(Alert::TYP_WARNING, $message, $location, $autoClose);
   }

   function error($message, $location=Alert::LOC_TOAST, $autoClose=TRUE)
   {
      $this->addAlert(Alert::TYP_ERROR, $message, $location, $autoClose);
   }

   function addAlert($type, $message, $location, $autoClose)
   {
      $autoClose = ($autoClose==TRUE) ? 'true' : 'false';

      $alerts    = $this->getAlerts();
      $alertId   = bin2hex(random_bytes(8));
      $newAlerts = array('type'      => $type, 
                         'message'   => $message, 
                         'location'  => $location, 
                         'alertId'   => $alertId, 
                         'autoClose' => $autoClose	);
                         
      $count     = array_push($alerts, $newAlerts);

      session()->setFlashdata('alerts', $alerts);
   }

   function getAlerts()
   {
      if( session()->getFlashdata('alerts') != null )
         return session()->getFlashdata('alerts');
      else
         return array();	
   }

   function isEmpty()
   {
      $alerts = session()->getFlashdata('alerts');

      if (is_null($alerts)) {
         return true;
      }
      else
      {	
         if (empty($alerts))
            return true;
         else
            return false;
      }
   }	

   function removeAlerts()
   {
      session()->setFlashdata('alerts', array());
   }
}