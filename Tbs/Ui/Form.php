<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui;

use Tbs\Ui\FullCalendar\FullCalendar;
use Tbs\Ui\Interfaces\IButton;
use Tbs\Ui\Interfaces\IToolbar;
use Tbs\Ui\Interfaces\IDataTable;
use Tbs\Ui\Interfaces\IFullCalendar;
use Tbs\Ui\Button\Button;

class Form extends ViewContentBase
{
   protected Page           $page;
   protected ?IToolbar      $toolbar   = null;
   protected ?IDataTable    $dataTable = null;
   protected ?IFullCalendar $fullCalendar = null;

   public function __construct(Page $page, string $id, string $title, string $view='', string $section='')
   {
      parent::__construct($id, $title, $view, $section);
      
      $this->page                         = $page; 
      $this->config                       = config("Tbs\\Ui\\Config\\Ui");

      $this->data['form_id']              = $this->id;
      $this->data['form_title']           = $this->title;
      $this->data['form_view']            = $this->view;
      $this->data['form_section']         = $this->section;
      $this->data['form_subTitle']        = '';
      $this->data['form_viewJs']          = '';
      $this->data['form_viewCss']         = '';
      $this->data['form_action']          = '';
      $this->data['form_actionBack']      = '';
      $this->data['form_titleAction']     = '';
   }

   public function setId(string $id) : Form
   {
      $this->id = $id;
      $this->data['form_id'] = $id;
      return $this;
   }  

   public function setTitle(string $title) : Form
   {
      $this->title = $title;
      $this->data['form_title'] = $title;
      return $this;
   }

   public function setView(string $view) : Form
   {
      $this->view = $view;
      $this->data['form_view'] = $view;
      return $this;
   }  

   public function setData(array $data=[]) : Form
   {
      $this->data = array_merge($this->data,$data);
      return $this;
   }

   public function setSection(string $section) : Form
   {
      $this->section = $section;
      $this->data['form_section'] = $section;
      return $this;
   }

   public function setSubtitle(string $title) : Form
   {
      $this->data['form_subTitle'] = $title;
      return $this;
   }
   
   public function subViewJs(string $view) : Form
   {
      $this->data['form_viewJs'] = $view;
      return $this;
   }

   public function viewCss(string $view) : Form
   {
      $this->data['form_viewCss'] = $view;
      return $this;
   }

   public function action(string $action, string $label='', string $id='', string $icon= '', string $class='') : Form
   {
      $this->data['form_action'] = $action;

      $this->addToolbarButton(Button::submit($this->id, $label, $id, $icon, $class));

      return $this;
   }

   public function actionBack(string $action, string $label, string $id='', string $icon= '') : Form
   {
      $this->data['form_actionBack'] = $action;

      $this->addToolbarButton(Button::back($action, $label, $id, $icon));

      return $this;
   }  

   public function actionTitle(string $action) : Form
   {
      $this->data['form_titleAction'] = $action;
      return $this;
   }

   public function addToolbarButton(IButton $button) : Form
   {
      $toolbar = $this->page->toolbar();
      $toolbar->addButton($button);
      return $this;
   }

   public function dataTable() : ?IDataTable
   {
      return $this->dataTable;
   }

   public function useDatatable(?array $dataset, ?string $tableId=null) : IDataTable
   {
      $tableId_ = $tableId;
      
      if(is_null($tableId)) {
         $tableId_ = $this->id . '_datatable';
      }
      
      $this->dataTable = new \Tbs\Ui\DataTable\DataTable($this->page, $tableId_);
      $this->dataTable->setDataset($dataset);
      
      return $this->dataTable;
   }

   public function fullCalendar() : ?IFullCalendar
   {
      return $this->fullCalendar;
   }

   public function addFullCalendar(string $inputBoxId) : Form
   {
      if(is_null($this->fullCalendar)) {
         $this->fullCalendar = new FullCalendar($this->page);
      }

      $this->fullCalendar->addInputBox($inputBoxId);
      return $this;
   }
   
}
