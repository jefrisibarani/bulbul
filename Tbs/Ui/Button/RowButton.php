<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Button;
  
class RowButton extends ButtonBase
{
   protected $rowId;

   public function __construct(
                  IAction $action,
                  $label='',
                  $id='',
                  $icon='',
                  $class='' )
   {
      parent::__construct($action, $label, $id, $icon, $class);
   }

   public static function edit(string $rowId, string $rowCaption='', string $rowHandler='edit', string $label='', string $id='', string $icon= 'fas fa-edit')
   {
      if(empty($label)) {
         $label = lang('Ui.edit');
      }

      //$action = 'tableRowEdit("\'+' .$rowId. '+\'","\'+' .$rowCaption. '+\'")';
      $action = '';
      $button = new RowButton(new ActionJS($action), $label, $id, $icon);
      $button->label = '';
      $button->title = $label;
      $button->class = 'btn_row btn_row_edit me-2';
      $button->dataVal = [
         'data-rowid'      => "'+ ".$rowId." +'",
         'data-rowcaption' => "'+ ".$rowCaption." +'",
         'data-rowhandler' => $rowHandler,
         'data-toggle'     => 'tooltip'
      ];
      
      return $button;
   }   
   
   public static function delete(string $rowId, string $rowCaption='', string $rowHandler='delete', string $label='', string $id='', string $icon= 'fas fa-trash-alt')
   {
      if(empty($label)) {
         $label =  lang('Ui.delete');
      }
      
      //$action = 'tableRowDelete("\'+' .$rowId. '+\'","\'+' .$rowCaption. '+\'")';
      $action = '';

      $button = new RowButton(new ActionJS($action), $label, $id, $icon);
      $button->label   = '';
      $button->title   = $label;
      $button->class   = 'btn_row btn_row_delete me-2';
      $button->dataVal = [
         'data-rowid'      => "'+ ".$rowId." +'",
         'data-rowcaption' => "'+ ".$rowCaption." +'",
         'data-rowhandler' => $rowHandler,
         'data-toggle'     => 'tooltip'
      ];
      
      return $button;
   }
}

