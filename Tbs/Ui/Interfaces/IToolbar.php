<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Interfaces;
use Tbs\Ui\Interfaces\IHtmlElement;
use Tbs\Ui\Interfaces\IButton;

interface IToolbar extends IHtmlElement
{
   public function addButton(IButton $button) : IToolbar;
}