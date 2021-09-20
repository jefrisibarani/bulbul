<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\FullCalendar;
use Tbs\Ui\Interfaces\IFullCalendar;
use Tbs\Ui\Page;

class FullCalendar implements IFullCalendar
{
   protected array $inputBoxes = [];
   protected Page $page;

   public function __construct(Page $page)
   {
      $this->page = $page;
   }

   public function inputBoxes() : array
   {
      return $this->inputBoxes;
   }

   public function addInputBox(string $inputBoxId) : FullCalendar
   {
      array_push ($this->inputBoxes, $inputBoxId);
      return $this;
   }

   public function html() : string
   {
      return view($this->page->partCommon('form_fullcalendar'));
   }
}