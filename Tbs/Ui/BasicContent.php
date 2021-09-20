<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui;

class BasicContent extends ViewContentBase
{
   public function __construct(string $id, string $title, string $view='', string $section='')
   {
      parent::__construct($id, $title, $view, $section);

      $this->config   = config("Tbs\\Ui\\Config\\Ui");

      $this->data['content_id']        = $this->id;
      $this->data['content_title']     = $this->title;
      $this->data['content_view']      = $this->view;
      $this->data['content_section']   = $this->section;
      $this->data['content_viewJs']    = '';
      $this->data['content_viewCss']   = '';
   }
}