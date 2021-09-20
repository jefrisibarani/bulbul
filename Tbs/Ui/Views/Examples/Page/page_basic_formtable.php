<?= $this->section('scripts') ?>

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

<?= $this->endSection() ?>