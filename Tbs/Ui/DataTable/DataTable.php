<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\DataTable;

use Tbs\Ui\Interfaces\IDataTable;
use Tbs\Ui\ViewContentBase;
use Tbs\Ui\Page;

class DataTable extends ViewContentBase implements IDataTable
{
   protected Page $page;
   protected ?array $dataset = null;
   protected ?array $columns = null;
   protected ?array $buttons = null;

   protected bool $useRowDelete     = false;
   protected bool $useRowEdit       = false;
   protected bool $useJSZip         = false;
   protected bool $usePdfMake       = false;
   protected bool $useAutoFill      = false;
   protected bool $useButtons       = false;
   protected bool $useDateTime      = false;
   protected bool $useFixedColumns  = false;
   protected bool $useFixedHeader   = false;
   protected bool $useKeyTable      = false;
   protected bool $useResponsive    = false;
   protected bool $useRowGroup      = false;
   protected bool $useRowReorder    = false;

   protected array $rowDeleteData = [
      'data-rowid' => 'id',            // table row id
      'data-rowcaption' => '',         // data caption displayed in confirmation dialog
      'data-rowhandler' => 'delete',   // controller method to handle the action
   ];

   protected array $rowEditData = [
      'data-rowid' => 'id',            // table row id
      'data-rowcaption' => '',         // data caption displayed in confirmation dialog
      'data-rowhandler' => 'edit',     // controller method to handle the action
   ];

   public function __construct(Page $page, $id)
   {
      parent::__construct($id, '', '', '');
      
      $this->page = $page;
      $this->config   = config("Tbs\\Ui\\Config\\Ui");

      $this->data['datatable_id']      = $this->id;
      $this->data['datatable_title']  	= $this->title;
      $this->data['datatable_view']    = $this->view;
      $this->data['datatable_section']	= $this->section;
   }

   public function setDataset(array $dataset) : DataTable
   {
      $this->dataset = $dataset;
      return $this;
   }

   public function setColumns(array $columns) : DataTable
   {
      $this->columns = $columns;
      return $this;
   }

   public function setButtons(array $buttons ) : DataTable
   {
		$this->buttons = $buttons;
		return $this;
   }   

   /**
    * Set datatable to use delete button for each row
    * @param string $rowIdSource Field column name prepended with 'row.' example: ''row.id''
    * @param string $rowCaptionSource Caption displayed in confirmation dialog
    * @param string $actionHandler Controller method to handle the action
    */
   public function setUseRowDelete(string $rowIdSource='row.id', string $rowCaptionSource='', string $actionHandler='delete') : DataTable
   {
      $this->rowDeleteData['data-rowid']      = $rowIdSource;
      $this->rowDeleteData['data-rowcaption'] = $rowCaptionSource;
      $this->rowDeleteData['data-rowhandler'] = $actionHandler;
      $this->useRowDelete = true;
      return $this;
   }

   /**
    * Set datatable to use edit button for each row
    * @param string $rowIdSource Field column name prepended with 'row.' example: ''row.id''
    * @param string $rowCaptionSource Caption displayed in confirmation dialog
    * @param string $actionHandler Controller method to handle the action
    */   
   public function setUseRowEdit(string $rowIdSource='row.id', string $rowCaptionSource='', string $actionHandler='edit') : DataTable
   {
      $this->rowEditData['data-rowid']      = $rowIdSource;
      $this->rowEditData['data-rowcaption'] = $rowCaptionSource;
      $this->rowEditData['data-rowhandler'] = $actionHandler;
      $this->useRowEdit = true;
      return $this;
   } 

   public function useRowDelete() : bool
   {
      return $this->useRowDelete;
   }

   public function useRowEdit() : bool
   {
      return $this->useRowEdit;
   }
   
   public function useJSZip() : bool
   {
      return $this->useJSZip;
   }

   public function usePdfMake() : bool
   {
      return $this->usePdfMake;
   }
   
   public function useAutoFill() : bool
   {
      return $this->useAutoFill;
   }

   public function useButtons() : bool
   {
      return $this->useButtons;
   }
   
   public function useDateTime() : bool
   {
      return $this->useDateTime;
   }

   public function useFixedColumns() : bool
   {
      return $this->useFixedColumns;
   }
   
   public function useFixedHeader() : bool
   {
      return $this->useFixedHeader;
   }

   public function useKeyTable() : bool
   {
      return $this->useKeyTable;
   }
   
   public function useResponsive() : bool
   {
      return $this->useResponsive;
   }

   public function useRowGroup() : bool
   {
      return $this->useRowGroup;
   }
   
   public function useRowReorder() : bool
   {
      return $this->useRowReorder;
   }
   
   public function rowDeleteData() : array
   {
      return $this->rowDeleteData;
   }

   public function rowEditData() : array
   {
      return $this->rowEditData;
   }    

   public function dataset() : ?array
   {
      return $this->dataset;
   }

   public function jsonDataSet() : ?string
   {
      $json = json_encode($this->dataset);
      if ($json === false) {
         return null;
      }
      else {
         return $json;
      }
   }

   public function columns() : ?array
   {
      return $this->dataset;
   }

   public function jsonColumns() : ?string
   {
      $json = json_encode($this->columns);
      if ($json === false) {
         return null;
      }
      else {
         return $json;
      }
   }   

   public function buttons() : ?array
   {
      return $this->buttons;
   } 

   public function colFreeze() : int
   {
      return 1;
   }

   public function html() : string
   {
      return view($this->page->partCommon('form_datatable'));
   }

}