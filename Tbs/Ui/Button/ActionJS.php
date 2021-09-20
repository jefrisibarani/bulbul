<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Button;
use Tbs\Ui\Button\IAction;

class ActionJS implements IAction
{
   protected string $javascript;
   protected string $command;

   public function __construct(string $javascript)
   {
      $this->javascript = $javascript;
   }

   public function type() : string
   {
      return 'onclick';
   }
   public function command() : string
   {
      return $this->javascript;
   }
}