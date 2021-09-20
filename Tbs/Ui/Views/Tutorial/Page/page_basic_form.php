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
            <a href="/examples/page_basic_form" class="nav-link" id="contact-tab" data-bs-toggle="_tab" data-bs-target="#_contact" type="buttonX" role="tabX" aria-controls="contact" aria-selected="false">Open</a>
         </li>
      </ul>

      <div class="tab-content" id="myTabContent">
         <!------------------------------------------------------------------------------------------->
         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
         File: Tbs/Ui/Controllers/ExamplesController.php

         <pre ><code data-language="php">
use Tbs\Ui\Controllers\PageController;
use Tbs\Ui\Button\Button;

// Entend from PageController
class ExamplesController extends PageController
{
   public function basicForm()
   {
      $formData = [
         'data_name'    => 'Mangapul',
         'data_address' => 'Cibitung',
         'data_phone'   => '081234567890'
      ];

      $formId = 'form_sample1';
      $this->page->setId("page_sample")
                 ->setTitle(lang('Examples.examples'))
                 ->setForm($formId, lang('Examples.basicFormTitle'))
                     ->setView('Tbs\Ui\Views\Examples\Page\page_basic_form')
                     ->setData($formData)
                     ->addToolbarButton(Button::back('/examples',                    lang('Examples.examples')))
                     ->addToolbarButton(Button::edit('/examples/page_basic_form'),   lang('Ui.edit'))
                     ->addToolbarButton(Button::submit($formId));

      return $this->page->show();
   }
}
      </code></pre>
         <p>
         <b>Note:</b><br/>
         </p>
         <code>addToolbarButton()</code> adds Button to Page's toolbar<br/>

         </div>

         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
         File: Tbs/Ui/Views/Examples/Page/page_basic_form.php
<!--------------------------------------------->
<pre class="mt-2"><code data-language="html">

&lt;?php helper('form'); ?>

<form action="&lt;?php echo base_url().$form_action ?>" method="post" id="&lt;?php echo $form_id;?>" class="">
   &lt;?= csrf_field() ?>
   <div class="row mt-3">
      <div class="col-sm-6">  <!-- Left Side -->
         <!-- NAMA -->
         <div class="mb-1 row">
            <label for="inputNama" class="col-sm-2 col-form-label">&lt;?=lang('Examples.name')?></label>
            <div class="col-sm-10">
               <input name="field_nama" class="form-control form-control-sm &lt;?php if(session('errors.field_nama')) : ?>is-invalid&lt;?php endif ?>" 
                  id="inputNama" type="text" placeholder="" 
                  value="&lt;?= set_value('field_nama', $data_name ?:''); ?>"/>
               <div class="invalid-feedback">&lt;?= session('errors.field_nama') ?></div>
            </div>
         </div>
         <!-- ALAMAT -->
         <div class="mb-1 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">&lt;?=lang('Examples.address')?></label>
            <div class="col-sm-10">
               <input name="field_alamat" class="form-control form-control-sm &lt;?php if(session('errors.field_alamat')) : ?>is-invalid&lt;?php endif ?>" 
                  id="inputPassword" type="text" placeholder=""
                  value="&lt;?= set_value('field_alamat', $data_address ?:''); ?>"/>
               <div class="invalid-feedback">&lt;?= session('errors.field_alamat') ?></div>
            </div>
         </div>
      </div>
      
      <div class="col-sm-6">  <!-- Right side -->
      </div>   
   </div>
</form>

</code>
</pre>
<!--------------------------------------------->
         </div>


         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="variables" role="tabpanel" aria-labelledby="variables-tab">
         View data variables generated and accessible from view files.

<pre class="mt-2"><code data-language="php">
$data_address           : "Cibitung"
$data_name              : "Mangapul"
$data_phone             : "081234567890"
$form_action            : ""
$form_actionBack        : ""
$form_id                : "form_sample1"
$form_section           : ""
$form_subTitle          : ""
$form_title             : "Basic form example #1"
$form_titleAction       : ""
$form_view              : "Tbs\Ui\Views\Examples\Page\page_basic_form"
$form_viewCss           : ""
$form_viewJs            : ""
$page                   : Tbs\Ui\Page
$page_content           : Tbs\Ui\Form
$page_contentTitle      : "Basic form example #1"
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