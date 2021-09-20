<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Controllers;

use Tbs\Ui\Controllers\PageController;
use Tbs\Ui\Alert\Alert;
use Tbs\Ui\Button\Button;

// Entends from PageController
class ExamplesController extends PageController
{
   public function index()
   {
      $this->page->setId("page_sample")
                 ->setTitle(lang('Examples.examples'))
                 ->setContentTitle(lang('Examples.examples'))
                 ->setContent("example_index", lang('Examples.examples'), 'Tbs\Ui\Views\Examples\index');
      
      return $this->page->show();	
   }

   public function basicPage()
   {
      return $this->page->setId("page_sample")
                        ->setView('Tbs\Ui\Views\Examples\Page\page_basic_page')
                        ->setTitle(lang('Examples.basicPageTitle'))
                        ->show();
   }

   public function basicPageData()
   {
      $data = [
         'data_name'	   => 'Mangapul',
         'data_address' => 'Jakarta',
      ];

      $this->page->setId("page_sample")
                 ->setView('Tbs\Ui\Views\Examples\Page\page_basic_page_data')
                 ->setTitle(lang('Examples.basicPageDataTitle'))
                 ->setData($data);

      return $this->page->show();
   }   

   public function basicContent()
   {
      $data = [
         'data_name'	   => 'Mangapul',
         'data_address' => 'Jakarta',
      ];

      $this->page->setId("page_sample")
                 ->setTitle(lang('Examples.examples'))
                 ->setContentTitle(lang('Examples.basicContentTitle')) // will be overriden on setContent()
                 ->setData($data)
                 ->setContent("basic_content", lang('Examples.basicContentTitle'), 'Tbs\Ui\Views\Examples\Page\page_basic_content');

      return $this->page->show();
   }

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

   public function basicForm2()
   {
      $pageData = [
         'data_name'    => 'Jefri',
         'data_address'	=> 'Jakarta'
      ];

      $formData = [
         'data_name'    => 'Mangapul',
         'data_address' => 'Cibitung',
         'data_phone'   => '081234567890'
      ];

      $formId = 'form_sample2';
      $this->page->setId("page_sample")
                 ->setTitle(lang('Examples.examples'))
                 ->setData( $pageData)
                 ->setForm($formId, lang('Examples.basicForm2Title'))
                     ->setView('Tbs\Ui\Views\Examples\Page\page_basic_form2')
                     ->setData($formData)
                     ->addToolbarButton(Button::back('/examples',                    lang('Examples.examples')))
                     ->addToolbarButton(Button::edit('/examples/page_basic_form2'),  lang('Ui.edit'))
                     ->addToolbarButton(Button::submit($formId));

      return $this->page->show();
   }

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

      $formId = 'form_sample4';
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
