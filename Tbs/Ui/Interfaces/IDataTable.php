<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Interfaces;
use Tbs\Ui\Interfaces\IHtmlElement;

interface IDataTable extends IHtmlElement
{
   public function setDataset(array $dataset) : IDataTable;

   public function dataset() : ?array;
}