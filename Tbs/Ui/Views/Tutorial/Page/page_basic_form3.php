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
            <a href="/examples/page_basic_form3" class="nav-link" id="contact-tab" data-bs-toggle="_tab" data-bs-target="#_contact" type="buttonX" role="tabX" aria-controls="contact" aria-selected="false">Open</a>
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
   public function basicForm3()
   {
      $formData = [
         'data_name'       => 'Mangapul',
         'data_address'    => 'Cibitung',
         'data_phone'      => '081234567890',
         'data_date_start' => '2021-09-01',
         'data_date_end'   => '2021-09-15',
      ];

      $formId = 'form_sample3';
      $this->page->setId("page_sample")
                 ->setTitle(lang('Examples.examples'))
                 ->setForm($formId, lang('Examples.basicForm3Title'))
                     ->setView('Tbs\Ui\Views\Examples\Page\page_basic_form3')
                     ->setData($formData)
                     
                     // These next three methods add button to toolbar. the order of the buttons, 
                     // follows the order of the method

                     // Add Button::back
                     ->actionBack('/examples', lang('Examples.examples'))
                     // Add Edit button
                     // note: define Javascript function enableFormEditing() in view file: Ui\Views\Examples\Page\page_basic_form3.php
                     ->addToolbarButton(Button::js('enableFormEditing()',  lang('Ui.edit'), '', 'fas fa-edit'), 'disabled')
                     // Set POST form action and add Button::Submit
                     // note: also see the handler: basicForm3Post() and Ui\Config\Routes.php
                     ->action('/examples/page_basic_form3_post', '', '', '', 'disabled')
                     
                     // Show full calendar for these input boxes
                     ->addFullCalendar('inputDateStart')
                     ->addFullCalendar('inputDateEnd');

      return $this->page->show();
   }

   public function basicForm3Post()
   {
      $rules = [
         'field_nama'         => 'required',
         'field_alamat'       => 'required',
         'field_date_start'   => 'required',
         'field_date_end'     => 'required',
      ];

      if (! $this->validate($rules)) {
         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
      }

      $fieldNama      = $this->request->getPost('field_nama');
      $fieldAlamat    = $this->request->getPost('field_alamat');
      $fieldDateStart = $this->request->getPost('field_date_start');
      $fieldDateEnd   = $this->request->getPost('field_date_end');

      // do something with collected POST data
      // ...
      service('alert')->info('field_nama = ' . $fieldNama);
      service('alert')->info('field_alamat = ' . $fieldAlamat);
      service('alert')->info('field_date_start = ' . $fieldDateStart);
      service('alert')->info('field_date_end = ' . $fieldDateEnd);


      service('alert')->success('Sukses');
      return redirect()->to('/examples/page_basic_form3');
   }

}
      </code></pre>
         <p>
         <b>Note:</b><br/>
         <br/>
         </p>

         </div>

         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
         File: Tbs/Ui/Views/Examples/Page/page_basic_form3.php

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
         <!-- Tanggal awal-->
         <div class="mb-1 row">
            <label for="inputDateStart" class="col-sm-3 col-form-label">&lt;?=lang('Examples.startDate')?></label>
            <div class="col-sm-9">
               <input name="field_date_start" class="form-control form-control-sm &lt;?php if(session('errors.field_date_start')) : ?>is-invalid&lt;?php endif ?>" 
                  id="inputDateStart" type="text" placeholder="" 
                  value="&lt;?= set_value('field_date_start', $data_date_start ?:''); ?>"/>
               <div class="invalid-feedback">&lt;?= session('errors.field_date_start') ?></div>
            </div>
         </div>
         <!-- Tanggal akhir-->
         <div class="mb-1 row">
            <label for="inputDateEnd" class="col-sm-3 col-form-label">&lt;?=lang('Examples.endDate')?></label>
            <div class="col-sm-9">
               <input name="field_date_end" class="form-control form-control-sm &lt;?php if(session('errors.field_date_end')) : ?>is-invalid&lt;?php endif ?>" 
                  id="inputDateEnd" type="text" placeholder=""
                  value="&lt;?= set_value('field_date_end', $data_date_end ?:''); ?>"/>
               <div class="invalid-feedback">&lt;?= session('errors.field_date_end') ?></div>
            </div>
         </div>
      </div>
   </div>
</form>

&lt;?= $this->section('scripts') ?>
   <script type="text/javascript">

      function enableFormEditing()
      {
         $('#inputNama').removeAttr('disabled');
         $('#inputPassword').removeAttr('disabled');
         $('#inputDateStart').removeAttr('disabled');
         $('#inputDateEnd').removeAttr('disabled');
         
         $('#uiBtnSubmit').removeClass('disabled');
         $('#uiBtnSubmit').removeAttr('tabindex');
         $('#uiBtnSubmit').removeAttr('aria-disabled');
      }

</script>
&lt;?= $this->endSection() ?>

</code>
</pre>
<!--------------------------------------------->
         </div>

         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="variables" role="tabpanel" aria-labelledby="variables-tab">
         View data variables generated and accessible from view files.

<pre class="mt-2"><code data-language="php">
$data_address           : "Cibitung"
$data_date_end          : "2021-09-15"
$data_date_start        : "2021-09-01"
$data_name              : "Mangapul"
$data_phone             : "081234567890"
$form_action            : "/examples/page_basic_form3_post"
$form_actionBack        : "/examples"
$form_id                : "form_sample3"
$form_section           : ""
$form_subTitle          : ""
$form_title             : "Basic form example #3"
$form_titleAction       : ""
$form_view              : "Tbs\Ui\Views\Examples\Page\page_basic_form3"
$form_viewCss           : ""
$form_viewJs            : ""
$page                   : Tbs\Ui\Page
$page_content           : Tbs\Ui\Form
$page_contentTitle      : "Basic form example #3"
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