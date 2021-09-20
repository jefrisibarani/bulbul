<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Button;
use Tbs\Ui\Button\ActionJS;
use Tbs\Ui\Button\ActionLink;
  
class Button extends ButtonBase
{
   public const ID_ADD     = 'uiBtnAdd';
   public const ID_EDIT    = 'uiBtnEdit';
   public const ID_DELETE  = 'uiBtnDelete';
   public const ID_BACK    = 'uiBtnBack';
   public const ID_OPEN    = 'uiBtnOpen';
   public const ID_SUBMIT  = 'uiBtnSubmit';
   public const ID_PRINT   = 'uiBtnPrint';

   public function __construct(
                  IAction $action,
                  $label='',
                  $id='',
                  $icon='',
                  $class='' )
   {
      parent::__construct($action, $label, $id, $icon, $class);
   }

   public static function add(string $url='', string $label='', string $id='', string $icon= '')
   {
      if(empty($label))
         $label =  lang('Ui.add');

      if(empty($id)) {
         $id = Button::ID_ADD;
      }

      if(empty($icon)) {
         $icon = 'fas fa-add';
      }

      return new Button(new ActionLink($url), $label, $id, $icon);
   }

   public static function edit(string $url='', string $label='', string $id='', string $icon= '')
   {
      if(empty($label))
         $label =  lang('Ui.edit');

      if(empty($id)) {
         $id = Button::ID_EDIT;
      }

      if(empty($icon)) {
         $icon = 'fas fa-edit';
      }

      return new Button(new ActionLink($url), $label, $id, $icon);
   }

   public static function delete(string $url='', $label='', string $id='', string $icon= '')
   {
      if(empty($label)) {
         $label =  lang('Ui.delete');
      }

      if(empty($id)) {
         $id = Button::ID_DELETE;
      }

      if(empty($icon)) {
         $icon = 'fas fa-trash-alt';
      }

      return new Button(new ActionLink($url), $label, $id, $icon);
   }
   
   public static function back(string $url='', string $label='', string $id='', string $icon= '')
   {
      if(empty($label)) {
         $label =  lang('Ui.back');
      }

      if(empty($id)) {
         $id = Button::ID_BACK;
      }

      if(empty($icon)) {
         $icon = 'fas fa-arrow-left';
      }

      return new Button(new ActionLink($url), $label, $id, $icon);
   }

   public static function open(string $url='', string $label='', string $id='', string $icon= '')
   {
      if(empty($label)) {
         $label =  lang('Ui.open');
      }

      if(empty($id)) {
         $id = Button::ID_OPEN;
      }

      if(empty($icon)) {
         $icon = 'fas fa-location-arrow';
      }

      return new Button(new ActionLink($url), $label, $id, $icon);
   }

   public static function js(string $script, string $label, string $id='', string $icon= '', string $class='')
   {
      if(empty($icon)) {
         $icon = 'fas fa-save';
      }

      $button = new Button(new ActionJS($script), $label, $id, $icon, $class);
      $button->position = 'me-3';
      
      return $button;
   }

   public static function submit(string $formId, string $label='', string $id='', string $icon= '', string $class='')
   {
      if(empty($label)) {
         $label =  lang('Ui.submit');
      }

      if(empty($id)) {
         $id = Button::ID_SUBMIT;
      }

      if(empty($icon)) {
         $icon = 'fas fa-save';
      }

      $button = new Button(new ActionJS("submitForm('".$formId."')"), $label, $id, $icon, $class);
      $button->position = 'me-3';
      
      return $button;
   }
   
   public static function print(string $label='', string $id='', string $icon= '')
   {
      if(empty($label)) {
         $label =  lang('Ui.print');
      }

      if(empty($id)) {
         $id = Button::ID_PRINT;
      }

      if(empty($icon)) {
         $icon = 'fas fa-print';
      }

      $button = new Button(new ActionJS('print()'),
                           $label, $id, $icon);
      $button->position = 'float-first';
      
      return $button;
   }

   public static function copyTable(string $elementId, string $label='', string $id='', string $icon= 'fas fa-clone')
   {
      if(empty($label)) {
         $label =  lang('Ui.copy');
      }

      $button = new Button(new ActionJS( 'selectElementContents(document.getElementById("' .$elementId. '"))' ), 
                           $label, $id, $icon);
      $button->position = 'float-first';
      
      return $button;
   }


}