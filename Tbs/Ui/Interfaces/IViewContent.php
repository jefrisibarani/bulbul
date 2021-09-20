<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Interfaces;

interface IViewContent
{
   public function id() : string;

   public function title() : string;

   public function view() : string;

   public function data() : array;

   public function section() : string;
}