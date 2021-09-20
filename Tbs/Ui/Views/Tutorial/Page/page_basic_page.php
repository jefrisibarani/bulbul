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
            <a href="/examples/page_basic_page" class="nav-link" id="contact-tab" data-bs-toggle="_tab" data-bs-target="#_contact" type="buttonX" role="tabX" aria-controls="contact" aria-selected="false">Open</a>
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
   public function basicPage()
   {
      return $this->page->setId("page_sample")
                        ->setView('Tbs\Ui\Views\Examples\Page\page_basic_page')
                        ->setTitle(lang('Examples.basicPageTitle'))
                        ->show();
   }
}
      </code></pre>
      <p>
         <b>Note:</b><br/>
         <table>
         <tr><td><code>setId()</code></td>     <td>Set Page id</td></tr>
         <tr><td><code>setView()</code></td>   <td>Set Page namespaced view file/template</td></tr>
         <tr><td><code>setTitle()</code></td>  <td>Set Page title</td></tr>
         </table>
         </p>

      <br/>
      <b>Alternate syntax #1</b>
      <pre><code data-language="php">
   public function basicPage()
   {
      $this->page->setId("page_sample")
                 ->setView('Tbs\Ui\Views\Examples\Page\page_basic_page')
                 ->setTitle(lang('Examples.basicPageTitle'));

      return $this->page->show();
   }
      </code></pre>

      <b>Alternate syntax #2</b>
      <pre><code data-language="php">
   public function basicPage()
   {
      $this->page->setId("page_sample");
      $this->page->setView('Tbs\Ui\Views\Examples\Page\page_basic_page');
      $this->page->setTitle(lang('Examples.basicPageTitle'));

      return $this->page->show();
   }
      </code></pre>      
         
         </div>

         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
         File: Tbs/Ui/Views/Examples/Page/page_basic_page.php
<pre class="mt-2"><code data-language="html">
<div class="card-body">
   <p class="mb-0">
      <h1>This is a basic page</h1>
   </p>
   <h3>Name     : Administrator</h2>
   <h3>Address  : Jakarta</h1>
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
$content_view           : "Tbs\Ui\Views\Examples\Page\page_basic_page"
$content_viewCss        : ""
$content_viewJs         : ""
$page                   : Tbs\Ui\Page
$page_content           : Tbs\Ui\BasicContent
$page_contentTitle      : ""
$page_id                : "page_sample"
$page_language          : "en"
$page_sessionExpNotice  : true
$page_sessionTimeout    : 1200
$page_theme             : "light"
$page_title             : "Basic page example"
$page_view              : "Tbs\Ui\Views\Examples\Page\page_basic_page"
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