<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Button;
use Tbs\Ui\Button\IAction;

class ActionLink implements IAction
{
   protected string $url;
   protected string $command;

   public function __construct(string $url)
   {
      $this->url = $url;
   }

   public function type() : string
   {
      return 'href';
   }
   public function command() : string
   {
      return $this->url;
   }
}
