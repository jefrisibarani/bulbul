<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">Empty content</h4>
  <p>This is default content when no view specified for a Page. <br/>
  Please set namespaced view content
  
  <pre><code data-language="php">
   // set from Page
   $this->page->setView('Tbs\Ui\Views\Examples\basic_content')
   </pre>

   <pre><code data-language="php">
   //set from Form
   $form->setView('Tbs\Ui\Views\Examples\basic_content')
   </pre>

   <pre><code data-language="php">
   // from the third parameter of Page's setContent()
   $this->page->setContent("basic_content", lang('Ui.basicContentExample'), 'Tbs\Ui\Views\Examples\basic_content');
   </pre>

   Example
   <pre><code data-language="php">
   class ExamplesController extends PageController
   {
      public function index()
      {
         $this->page->setId("page_sample")
                 ->setTitle(lang('Ui.uiExamples'))
                 ->setContentTitle(lang('Ui.exampless'))
                 ->setContent("example_index", lang('Ui.examples'), 'Tbs\Ui\Views\Examples\index');

      return $this->page->show();	
   }
</code></pre>

</div>

<?= $this->section('css') ?>
   <link href="<?php echo base_url()."/vendor/rainbow/github.css"; ?>" rel="stylesheet" type="text/css">
<?= $this->endSection() ?>

<?= $this->section('vendor_scripts') ?>
   <script src="<?php echo base_url()."/vendor/rainbow/rainbow.js"; ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>


