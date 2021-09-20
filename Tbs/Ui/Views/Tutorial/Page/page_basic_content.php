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
            <a href="/examples/page_basic_content" class="nav-link" id="contact-tab" data-bs-toggle="_tab" data-bs-target="#_contact" type="buttonX" role="tabX" aria-controls="contact" aria-selected="false">Open</a>
         </li>
      </ul>

      <div class="tab-content" id="myTabContent">
         <!------------------------------------------------------------------------------------------->
         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
         File: Tbs/Ui/Controllers/ExamplesController.php

         <pre ><code data-language="php">
use Tbs\Ui\Controllers\PageController;

// Entend from PageController
class ExamplesController extends PageController
{
   public function basicContent()
   {
      $data = [
         'data_name'    => 'Mangapul',
         'data_address' => 'Jakarta',
      ];

      $this->page->setId("page_sample")
                 ->setTitle(lang('Examples.examples'))
                 ->setContentTitle(lang('Examples.basicContentTitle')) // optional, overriden in setContent()
                 ->setData($data)
                 ->setContent("basic_content", lang('Examples.basicContentTitle'), 'Tbs\Ui\Views\Examples\Page\page_basic_content');

      return $this->page->show();	
   }
}
      </code></pre>
         <p>
         <b>Note:</b><br/>
         Content title set on <code>setContent()</code>, will override title set on <code>setTitle()</code><br/>
         If both <code>setContent()</code> and <code>setTitle()</code> set empty title string, then Page will not show content title.
         </p>


         </div>

         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
         File: Tbs/Ui/Views/Examples/Page/page_basic_content.php

<pre class="mt-2"><code data-language="html">
<div class="card-body">
   <p class="mb-0">
      <h1>This is a basic page content</h1>
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
$content_id             : "basic_content"
$content_section        : ""
$content_title          : "Basic content example"
$content_view           : "Tbs\Ui\Views\Examples\Page\page_basic_content"
$content_viewCss        : ""
$content_viewJs         : ""
$data_address           : "Jakarta"
$data_name              : "Mangapul"
$page                   : Tbs\Ui\Page
$page_content           : Tbs\Ui\BasicContent
$page_contentTitle      : "Basic content example"
$page_id                : "page_sample"
$page_language          : "en"
$page_sessionExpNotice  : true
$page_sessionTimeout    : 1200
$page_theme             : "light"
$page_title             : "UI Examples"
$page_view              : ""
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