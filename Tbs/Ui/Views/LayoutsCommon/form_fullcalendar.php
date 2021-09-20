<?php
use Tbs\Ui\Form;
   $form = $page->content();
   if(!($form instanceof Form )) {
      service("alert")->error("Invalid Pages's form type");
   }
?>

<?php if($form->fullCalendar()->inputBoxes()) {?>
<?= $this->section('scripts') ?>
   <script type="text/javascript">

      function showDialogGoogleCalendar(dateInputBox) {
         var dialog = bootbox.dialog({
            title: '<?php echo lang('Ui.chooseDate'); ?>',
            size: 'large',
            message: '<?php echo lang('Ui.chooseDate'); ?>',
            onEscape: true,
            backdrop: true,
            buttons: {
               //cancel: {label: '<i class="fas fa-times"></i> <?php echo lang('Ui.cancel'); ?>'},
               //confirm: {label: '<i class="fas fa-check"></i> <?php echo lang('Ui.ok'); ?>'}
            },
            callback: function (result) {
               if (result) { }
            }
         });
         
         dialog.init(function() {
            dialog.find('.bootbox-body').html("<div class='loader' id='calendarloader'></div><div id='calendar'></div>");
            initCalendar(dateInputBox, dialog);
         });
      }

      function initCalendar(dateInputBox, dialogCalendar) {
         var calendarEl = document.getElementById('calendar');
         var calendar = new FullCalendar.Calendar(calendarEl, {
            contentHeight: 400,
            editable: true,      // enable draggable events
            aspectRatio: 1.2,
            scrollTime: '00:00', // undo default 6am scrollTime
               headerToolbar: {
               right: 'prev,next today',
               center: 'title',
               left: 'dayGridMonth,listYear'
            },
            initialView: 'dayGridMonth',
            displayEventTime: false,
            googleCalendarApiKey: 'AIzaSyDTG6PGOB-Id59NbMZKLVzf3WGKul2teEY',
            events: 'id.indonesian#holiday@group.v.calendar.google.com',
            eventClick: function(arg) {
               // opens events in a popup window
               window.open(arg.event.url, 'gcalevent', 'width=700,height=600');
               // prevent browser from visiting event's URL in the current tab
               arg.jsEvent.preventDefault();
            },
            dateClick: function(info) {
               //info.dayEl.style.backgroundColor = 'red';
               var selected = info.dateStr;
               dateInputBox.val(selected);
               dateInputBox.trigger("change");
               dialogCalendar.modal('hide');
            },
            loading: function(bool) {
               document.getElementById('calendarloader').style.display = bool ? 'block' : 'none';
            }
         });

         calendar.render();
         //calendar.updateSize();
      }

      TBS.FC = {
         showDialogGetCalendar: null,
      };

      $(function() {
         TBS.FC.showDialogGetCalendar = showDialogGoogleCalendar;

         <?php foreach ($form->fullCalendar()->inputBoxes() as $inputBox) { ?>
         $( '#<?php echo $inputBox?>' ).click(function( event ) {
            TBS.FC.showDialogGetCalendar($('#<?php echo $inputBox?>'));
         });
         <?php } ?>
      });
      
   </script>
<?= $this->endSection() ?>
<?php } ?>


<?= $this->section('css') ?>
      <link href="<?php echo base_url().'/vendor/fullcalendar-5.9.0/main.min.css'; ?>" rel='stylesheet' />
<?= $this->endSection() ?>

<?= $this->section('vendor_scripts') ?>
      <script type="text/javascript" src="<?php echo base_url().'/vendor/fullcalendar-5.9.0/main.min.js'; ?>"></script>

   <?php if( !is_null($form->dataTable()) && ($form->dataTable()->useRowDelete() || $form->dataTable()->useRowEdit() ) ) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/bootbox/bootbox.min.js' ?>"></script>
   <?php } ?>

<?= $this->endSection() ?>
