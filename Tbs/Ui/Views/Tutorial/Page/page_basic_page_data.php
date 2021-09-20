      <!-- ======================================================================================= -->
      <ul class="nav nav-tabs mb-3 mt-3" id="myTab" role="tablist">
         <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Controller</button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="view-tab" data-bs-toggle="tab" data-bs-target="#view" type="button" role="tab" aria-controls="view" aria-selected="false">View</button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="variables-tab" data-bs-toggle="tab" data-bs-target="#variables" type="button" role="tab" aria-controls="variables" aria-selected="false">Generated View Variables</button>
         </li>          
         <li class="nav-item" role="presentation">
            <a href="/examples/page_basic_page_data" class="nav-link" id="contact-tab" data-bs-toggle="_tab" data-bs-target="#_contact" type="buttonX" role="tabX" aria-controls="contact" aria-selected="false">Open</a>
         </li>
      </ul>

      <div class="tab-content" id="myTabContent">
         <!------------------------------------------------------------------------------------------->
         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
         File: Tbs/Ui/Controllers/ExamplesController.php

         <pre ><code data-language="php">
use Tbs\Ui\Controllers\PageController;

// Entends from PageController
class ExamplesController extends PageController
{
   public function basicPageData()
   {
      $data = [
         'data_name'    => 'Mangapul',
         'data_address' => 'Jakarta',
      ];

      $this->page->setId("page_sample")
                 ->setView('Tbs\Ui\Views\Examples\Page\page_basic_page_data')
                 ->setTitle(lang('Examples.basicPageDataTitle'))
                 ->setData($data);

      return $this->page->show();
   }
}
      </code></pre>
         <p>
         <b>Note:</b><br/>
         Use <code>setData()</code> to send $data to view/page
         </p>

         </div>

         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
         File: Tbs/Ui/Views/Examples/Page/page_basic_page_data.php
         
<pre class="mt-2"><code data-language="html">
<div class="card-body">
   <p class="mb-0">
      <h1>This is a basic page with data</h1>
   </p>
   <h3>Name     : &lt;?php echo(empty($data_name) ? '': $data_name) ?></h2>
   <h3>Address  : &lt;?php echo(empty($data_address) ? '': $data_address) ?></h1>
</div>
</code>
</pre>
         </div>


         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="variables" role="tabpanel" aria-labelledby="variables-tab">
         View data variables generated and accessible from view files.

<pre class="mt-2"><code data-language="php">
$content_id             : "content_basic"
$content_section        : ""
$content_title          : ""
$content_view           : "Tbs\Ui\Views\Examples\Page\page_basic_page_data"
$content_viewCss        : ""
$content_viewJs         : ""
$data_address           : "Jakarta"
$data_name              : "Mangapul"
$page                   : Tbs\Ui\Page
$page_content           : Tbs\Ui\BasicContent
$page_contentTitle      : ""
$page_id                : "page_sample"
$page_language          : "en"
$page_sessionExpNotice  : true
$page_sessionTimeout    : 1200
$page_theme             : "light"
$page_title             : "Basic page with data example"
$page_view              : "Tbs\Ui\Views\Examples\Page\page_basic_page_data"
$this                   : CodeIgniter\View\View
</code>
</pre>
         </div>

         <!--div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div-->
      </div> <!-- /tab -->

<?= $this->section('css') ?>
   <link href="<?php echo base_url()."/vendor/rainbow/github.css"; ?>" rel="stylesheet" type="text/css">
<?= $this->endSection() ?>

<?= $this->section('vendor_scripts') ?>
   <script src="<?php echo base_url()."/vendor/rainbow/rainbow.js"; ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>