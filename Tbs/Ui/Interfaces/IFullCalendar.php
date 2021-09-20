<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Interfaces;
use Tbs\Ui\Interfaces\IHtmlElement;

interface IFullCalendar extends IHtmlElement
{
   public function addInputBox(string $inputBoxId) : IFullCalendar;
}