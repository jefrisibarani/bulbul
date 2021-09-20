<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Button;

interface IAction
{
   public function type() : string;
   public function command() : string;
}