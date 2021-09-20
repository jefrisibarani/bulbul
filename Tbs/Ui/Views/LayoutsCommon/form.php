<?= $this->extend($page->layout()) ?>
<?= $this->section('content') ?>

<!-- Form Layout -------------------------------------------------------------->

<div class="card">
   <div class="card-header">
      <i class="fas fa-tags"></i>
         <!-- Form sub title -->
         <?php
         if ( empty($form_subTitle) ) {
            $form_subTitle = $form_title;
         }
 
         if(!empty($form_titleAction)) {
            $url = base_url() . '/'. $form_titleAction;
         }
         else {
            $url = base_url() . '/'. $page->request()->getPath();
         }
         
         echo '<a href="'. $url. '">'. $form_subTitle . '</a>';
         
         //if ( !empty($form_subTitle) ) {
         //	echo ' / <i>' . $form_subTitle . '</i>';
         //}
         ?>
         <!-- /Form sub title -->
         <!-- Collabsible Form Toggle Button -->
         <?php 
         if( !empty($form_view) OR ($form_view === 'form_filter')) { ?>
         <button id="btnToggleCollapsibleForm" class="btn btn-sm btn-primary float-end" 
                 type="button" data-toggle="collapse" data-target="#collapsibleForm"
                 aria-expanded="false" aria-controls="collapsibleForm">
            <i class="fas fa-chevron-up"></i>
         </button>
         <?php } ?>
         <!-- /Collabsible Form Toggle Button -->
   </div>
   

   <div class="card-body">
      <!-- Form Toolbar/buttons -->
      <?php echo $page->toolbar()->html(); ?>
      <!--hr style="margin:8px 0px;"/-->

      <!-- Alerts/Flashdata inside form -->
      <div id="alerts_in-form" class="alert_container d-none"></div>
      
      <!-- Form Content -->
      <?php
      use Tbs\Ui\Form;
      $form = $page->content();
      if($form instanceof Form ) 
      {
         if (!is_null($form->dataTable()))
         {
            echo $form->dataTable()->html();
         }
      }
      ?>

      <?php if(!empty($form_view)) echo $this->include($form_view); ?>
      <!-- /Form Content -->
   </div>
   

   <!-- Table Content -->
   <?php
   use Tbs\Ui\Alert\Alert;
   
   if(!empty($form_table))
   { 
      if ($form_table === 'TABLE_EMPTY' ) {
         $page->alert()->warning(lang('tbs_form_no_dbdata'), Alert::LOC_PAGE);
      }
      else
      {
         if(!empty($title_report)) 
         {
            // table comes from Report Controller
            echo '<hr id="hrReport" class="" style="margin:6px 0px;"/>';
            echo '<div id="title_report">'.$title_report. '</div>';
         }
         echo '<div class="table-scrollable-x">'. $form_table .'</div>'; 
      }
   } 
   
   ?> 
   <!--div class="card-footer small text-muted"></div-->
</div>
<!-- /Form Layout ------------------------------------------------------------>
<?= $this->endSection() ?>

<?php
      if (!is_null($form->fullCalendar()))
      {
         echo $form->fullCalendar()->html();
      }
?>