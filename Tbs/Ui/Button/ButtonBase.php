<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Button;

use Tbs\Ui\Interfaces\IButton;
use Tbs\Ui\Button\IAction;

class ButtonBase implements IButton
{
   public IAction $action;
   public $label     = '';
   public $href      = '';
   public $onclick   = '';
   public $id        = '';
   public $title     = '';
   public $style     = '';
   public $class     = 'btn btn-outline-primary btn-sm me-2';
   public $attibute  = '';
   public $disabled  = false;
   public $menuId    = '';
   public $icon      = 'fas fa-circle';
   public $position  = '';
   public ?array $dataVal = null;

   public function __construct(
                  IAction $action,
                  $label='',
                  $id='',
                  $icon='',
                  $class='')
   {
      $this->action = $action;


      if(!empty($label)) {
         $this->label = $label;
      }

      if (!empty($id)) {
         $this->id = $id;
      }

      if(!empty($icon)) {
         $this->icon = $icon;
      }
      
      if (!empty($class)) {
         $this->class .= ' ' . $class;
      }
   }

   public function action() : IAction
   {
      return $this->action;
   }

   public function html() : string
   {
      $sb = '';
      $sb .= '<a class="';

      if ( !empty($this->class) ) {
         if (strpos($this->class, 'disabled') !== false) {
            $this->disabled = true;
         }
      }
       
      // optional classes starts here
      if ( !empty($this->class) ) {
         $sb .= $this->class;
      }

      if ( !empty($this->position) ) {
         $sb .= ' '. $this->position;
      }

      $sb .= '"';

      /// class end.

      if (!empty($this->id) ) {
         $sb .= ' id="'. $this->id . '"';
      }

      if (!empty($this->href)  && !$this->disabled ) {
         $sb .= ' href="'. $this->href . '"';
      }
      else if($this->action instanceof ActionLink && !$this->disabled) {
         $url = base_url() . $this->action->command();
         $sb .= ' href="'. $url . '"';
      }

      //if (empty($this->href)) {
      // $sb .= ' href=""';
      //}

      if (!empty($this->onclick)/* && !$this->disabled */) {
         $sb .= ' onclick="'. $this->onclick . '"';
      }     
      else if($this->action instanceof ActionJS/* && !$this->disabled*/) 
      {
         $onclick = $this->action->command();
         if(!empty($onclick)) {
            $sb .= ' onclick="'. $onclick . '"';
         }
      }

      if(!is_null($this->dataVal))
      {
         // generate data-key="value"
         foreach ($this->dataVal as $key=>$val)
         {
            $sb .= ' '.$key.'="'.$val.'"';
         }
      }

      if (empty($this->title)) {
         $this->title = $this->label;
      }

      if (!empty($this->title)) {
         $sb .= ' title="' . $this->title . '"';
      }

      if (!empty($this->style)) {
         $sb .= ' style="' . $this->style . '"';
      }

      if ( $this->disabled ) {
         $sb .= ' tabindex="-1" aria-disabled="true"';
      }

      $sb .= ' role="button">';

      if (!empty($this->icon)) {
         $sb .= '<i class="' . $this->icon . '"></i>';
      }

      if (!empty($this->label)) {
         $sb .= ' ' . $this->label;
      }

      $sb .= '</a>';

      return $sb;
   }
}