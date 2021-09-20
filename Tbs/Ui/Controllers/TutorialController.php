<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Ui\Controllers;

use Tbs\Ui\Controllers\PageController;
use Tbs\Ui\Button\Button;

class TutorialController extends PageController
{
   public function index()
   {
      $this->page->setId("page_tutor")
                 ->setTitle(lang('Tutorial.tutorial'))
                 ->setContentTitle(lang('Tutorial.tutorial'))
                 ->setContent("tutor_index", lang('Tutorial.tutorial'), 'Tbs\Ui\Views\Tutorial\index');
      
      return $this->page->show();
   }

   public function showPage($pageName)
   {
      $pageTitle        = lang('Tutorial.tutorial');
      $formView         = 'Tbs\\Ui\\Views\\Tutorial\\Page\\' . $pageName;
      $formTitle        = lang('Tutorial.'.$pageName.'Title');
      $formAction       = '/tutorial/'. $pageName;
      $formActionTitle  = '/tutorial/'. $pageName;

      // Previous page button
      $prevUri                = previous_url(true);
      $formActionBack         = $prevUri->getPath();
      $formActionBackTitle    = lang('Tutorial.' . $prevUri->getSegment(2));
      
      $formSubtitle           = lang('Tutorial.' . $pageName);

      $formData = [
         'data_name'		=> 'Jefri',
         'data_address'	=> 'Cibitung',
         'data_phone'	=> '081234567890'
      ];

      $formId = 'form_tutorial';
      $this->page->setId("page_tutor")
                 ->setTitle($pageTitle)
                 ->setForm($formId, $formTitle)
                     ->setSubTitle($formSubtitle)
                     ->setView($formView)
                     ->setData($formData)
                     ->actionTitle($formActionTitle)

                     ->actionBack($formActionBack, $formActionBackTitle)
                     ->addToolbarButton(Button::open('/examples/'. $pageName, lang('Ui.open')));

      return $this->page->show();
   }
}
