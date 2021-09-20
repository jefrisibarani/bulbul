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
            <a href="/examples/page_basic_formtable" class="nav-link" id="contact-tab" data-bs-toggle="_tab" data-bs-target="#_contact" type="buttonX" role="tabX" aria-controls="contact" aria-selected="false">Open</a>
         </li>
      </ul>

      <div class="tab-content" id="myTabContent">
         <!------------------------------------------------------------------------------------------->
         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
         File: Tbs/Ui/Controllers/ExamplesController.php

         <pre ><code data-language="php">
use Tbs\Ui\Controllers\PageController;
use Tbs\Ui\Button\Button;
use Tbs\Ui\Alert\Alert;

// Extend from PageController
class ExamplesController extends PageController
{
   public function basicFormTable()
   {
      $config    = config('Tbs\Auth\Config\Auth');
      $repoClass = $config->authenticationRepo;
      $authRepo  = new $repoClass();
      $users     = $authRepo->getUsers();

      if (!empty($users)) {
         $allUsers = $users;
      }
      else 
      {
         $message  = $authRepo->getMessage();
         $feedback = $authRepo->getError();
         service('alert')->error($$message ?? $feedback , Alert::LOC_PAGE);
      }

      $formData = [
         'data_tableData'  => json_encode($users),
      ];

      $formId = 'form_sample3';
      $this->page->setId("page_sample")
                 ->setTitle(lang('Examples.examples'))
                 ->setForm($formId, lang('Examples.basicFormTableTitle'))
                     ->setView('Tbs\Ui\Views\Examples\Page\page_basic_formtable')
                     ->setData($formData)
                     ->addToolbarButton(Button::back('/examples', lang('Examples.examples')))
                     ->useDatatable($users)
                           // create delete button for each row and when clicked
                           // will execute HTTP(Ajax) POST request to http://localhost/examples/page_basic_formtable/deleteuser
                           ->setUseRowDelete('row.id','row.userName', 'edituser')
                           // create edit button for each row and when clicked
                           // will open edit page ex: http://localhost/examples/page_basic_formtable/deleteuser/1
                           ->setUseRowEdit('row.id','row.userName', 'deleteuser')
                           /*->setButtons(['copy', 'excel', 'pdf'])*/
                           ->setColumns([
                                 [ 'data' => "null"           , 'title' => 'Action'],
                                 [ 'data' => "id"             , 'title' => 'Id'],
                                 [ 'data' => "userName"       , 'title' => 'Username'],
                                 [ 'data' => "firstName"      , 'title' => 'First name'],
                                 [ 'data' => "lastName"       , 'title' => 'Last Name'],
                                 [ 'data' => "email"          , 'title' => 'Email'],
                                 [ 'data' => "password"       , 'title' => 'Password'],
                                 [ 'data' => "token"          , 'title' => 'Token'],
                                 [ 'data' => "selectedSiteId" , 'title' => 'Site Id'],
                                 [ 'data' => "selectedLangId" , 'title' => 'Lang Id'],
                                 [ 'data' => "uniqueCode"     , 'title' => 'Unique code'],
                                 [ 'data' => "birthDate"      , 'title' => 'Birthdate'],
                                 [ 'data' => "phone"          , 'title' => 'Phone'],
                                 [ 'data' => "address"        , 'title' => 'Address'],
                                 [ 'data' => "gender"         , 'title' => 'Gender'],
                                 [ 'data' => "nik"            , 'title' => 'Nik'],
                              ]);

      return $this->page->show();
   }
}
      </code></pre>
         <p>
         <b>Note:</b><br/>
         </p>

         </div>

         <!------------------------------------------------------------------------------------------->
         
         <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
         File: Tbs/Ui/Views/Examples/Page/page_basic_formtable.php

<!--------------------------------------------->
<pre class="mt-2"><code data-language="html">

&lt;?= $this->section('scripts') ?>

   <script type="text/javascript">
      // Replace DataTables option
      /*
      TBS.DT.fnGetDataTableOption = function() {
         var options = {};
         return options;
      }
      */

      // override datatable's delete button onClick event handler
      /*
      TBS.DT.fnConfirmEditCallback = function(event) {
         TBS_LOG('Event current target is : ' + event.currentTarget.className);

         event.preventDefault(); // prevent to open link "#"
         var _rowid   = $(this).attr('data-rowid');
         var _caption = $(this).attr('data-rowcaption');
         var _handler = $(this).attr('data-rowhandler');
         TBS_LOG('Row id : ' + _rowid + ', Caption: ' + _caption);
      }
      */
      
      // override datatable's edit button onClick event handler
      /*
      TBS.DT.fnConfirmDeleteCallback = function(event) {
         TBS_LOG('Event current target is : ' + event.currentTarget.className);

         event.preventDefault(); // prevent to open link "#"
         var _rowid   = $(this).attr('data-rowid');
         var _caption = $(this).attr('data-rowcaption');
         var _handler = $(this).attr('data-rowhandler');
         TBS_LOG('Row id : ' + _rowid + ', Caption: ' + _caption);
      }
      */

      // override table row delete action
      /*
      TBS.DT.fnBootboxDeleteCallback = function(option) {
         TBS_LOG('Row caption is : ' + option.caption);
      }
      */
      
      // override table row edit action
      /*
      TBS.DT.fnBootboxEditCallback = function(option) {
         TBS_LOG('Row caption is : ' + option.caption);
      }
      */

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
$data_tableData         : "[{"id":1,"userName":"admin@example.com","firstName":"Admin ","lastName":"App","email":"admin@example.com","password":null,"token":null,"selectedSiteId":0,"selectedLangId":null,"uniqueCode":"333333","birthDate":"2000-01-01T00:00:00","phone":"444444","address":"Bekasi Jawa Barat","gender":"M","nik":"555555"},{"id":2,"userName":"smith@example.com","firstName":"","lastName":"Smith","email":"smith@example.com","password":null,"token":null,"selectedSiteId":0,"selectedLangId":null,"uniqueCode":"252525","birthDate":"2010-10-13T00:00:00","phone":"252525","address":"S","gender":"M","nik":"252525\r\n"},{"id":3,"userName":"diana@example.com","firstName":"Diana","lastName":"Prince","email":"diana@example.com","password":null,"token":null,"selectedSiteId":0,"selectedLangId":null,"uniqueCode":null,"birthDate":"0001-01-01T00:00:00","phone":null,"address":null,"gender":null,"nik":null},{"id":4,"userName":"peter@example.com","firstName":"Peter","lastName":"Parker","email":"peter@@example.com","password"...
$form_action            : ""
$form_actionBack        : ""
$form_id                : "form_sample3"
$form_section           : ""
$form_subTitle          : ""
$form_title             : "Basic form datatable example"
$form_titleAction       : ""
$form_view              : "Tbs\Ui\Views\Examples\Page\page_basic_formtable"
$form_viewCss           : ""
$form_viewJs            : ""
$page                   : Tbs\Ui\Page
$page_content           : Tbs\Ui\Form
$page_contentTitle      : "Basic form datatable example"
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