<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Toolbar;

use Tbs\Ui\Interfaces\IButton;
use Tbs\Ui\Interfaces\IToolbar;
use Tbs\Ui\ViewContentBase;
use Tbs\Ui\Page;

class Toolbar extends ViewContentBase implements IToolbar
{
   protected Page $page;

   public function __construct(Page $page, $id)
   {
      parent::__construct($id, '', '', '');
      
      $this->page = $page;
      $this->config   = config("Tbs\\Ui\\Config\\Ui");

      $this->data['toolbar_id']        = $this->id;
      $this->data['toolbar_title']     = $this->title;
      $this->data['toolbar_view']      = $this->view;
      $this->data['toolbar_section']   = $this->section;
      $this->data['toolbar_buttons']   = [];
   }

   public function addButton(IButton $button) : Toolbar
   {
      array_push ($this->data['toolbar_buttons'], $button);
      return $this;
   }	

   public function html() : string
   {
      return view($this->page->partCommon('form_toolbar'));
   }
}