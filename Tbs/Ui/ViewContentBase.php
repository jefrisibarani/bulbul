<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui;
use Tbs\Ui\Interfaces\IViewContent;

class ViewContentBase implements IViewContent
{
   protected string  $id;
   protected string  $title;
   protected string  $view;
   protected array   $data;
   protected string 	$section;

   public function __construct(string $id, string $title, string $view='', string $section='')
   {
      $this->id      = $id;
      $this->title   = $title;
      $this->view    = $view;
      $this->section = $section;
      $this->data    = [];
   }

   public function id() : string
   {
      return $this->id;
   }

   public function title() : string
   {
      return $this->title;
   }	

   public function view() : string
   {
      return $this->view;
   }

   public function data() : array
   {
      return $this->data;
   }

   public function section() : string
   {
      return $this->section;
   }

   public function setId(string $id) : ViewContentBase
   {
      $this->id = $id;
      return $this;
   }	

   public function setTitle(string $title) : ViewContentBase
   {
      $this->title = $title;
      return $this;
   }

   public function setView(string $view) : ViewContentBase
   {
      $this->view = $view;
      return $this;
   }

   public function setData(array $data=[]) : ViewContentBase
   {
      $this->data = $data;
      return $this;
   }

   public function setSection(string $section) : ViewContentBase
   {
      $this->section = $section;
      return $this;
   }
}