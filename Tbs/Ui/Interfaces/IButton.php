<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Interfaces;

use Tbs\Ui\Button\IAction;
use Tbs\Ui\Interfaces\IHtmlElement;

interface IButton extends IHtmlElement
{
   public function action() : ?IAction;
}