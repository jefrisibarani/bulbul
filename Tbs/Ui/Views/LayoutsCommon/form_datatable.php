<?php
use Tbs\Ui\Button\RowButton;
use Tbs\Ui\Form;
   $form = $page->content();
   if(!($form instanceof Form )) {
      service("alert")->error("Invalid Pages's form type");
   }
?>

<div class="mt-3">
   <table id="<?php echo $form->dataTable()->id() ?>" class="table table-striped table-bordered table-sm table-stripped table-hover" cellspacing="0" width="100%"></table>
</div>



<?= $this->section('scripts') ?>

   <script type="text/javascript">

      $(function() {
         TBS.DT.showTable();
      });

      TBS.DT = {
         dataTable: null,
         dataTableDataset: <?php echo $form->dataTable()->jsonDataset() ?>,
         fnConfirmEditCallback: onConfirmEditCallback,
         fnConfirmDeleteCallback: onConfirmDeleteCallback,
         fnBootboxDeleteCallback: null,  // called from onConfirmDeleteCallback
         fnBootboxEditCallback: null,    // called from onConfirmEditCallback
         fnGetDataTableOption: null,     // user defined function to build DataTables option
         dataTableDrawCallback: function(settings) {
            var toolbarContainer = document.getElementById("toolbar_container");
            var dtPaging         = document.getElementById("<?php echo $form->dataTable()->id().'_paginate'?>");

            if(dtPaging != null) {
               dtPaging.firstElementChild.classList.add('pagination-sm');
               dtPaging.classList.add('float-end');

               var pagingWrap = document.createElement('span');

               //pagingWrap.id='dtPagingWrapper';
               pagingWrap.classList.add('dtPagingWrapper');
               pagingWrap.classList.add('container');
               pagingWrap.classList.add('tbs_nav');
               pagingWrap.appendChild(dtPaging);

               var toolbars = document.getElementsByClassName("form_toolbar");
               for (i = 0; i < toolbars.length; i++) {
                  toolbars[i].appendChild(pagingWrap);
               }
            }
         },
         showTable: function() {
            var dtTable  = null;
            var dtOption = {
               data:             this.dataTableDataset,
               autoWidth:        false,
               scrollY:          450,
               scrollX:          true,
               scrollCollapse:   true,
               paging:           true,
               searching:        true,
               info:             true,
               ordering:         true,
               responsive:       false,
               columns:          <?php echo $form->dataTable()->jsonColumns() ?>,
               //fixedColumns    true
               /*
               fixedColumns: {
                  leftColumns: <?php echo empty($form->dataTable()->colFreeze()) ? "1" : $form->dataTable()->colFreeze() ?>,
                  //rightColumns: 1
               },
               */
               columnDefs: [
                  {
                     targets: 0, searchable: false, orderable: false, width:'10%', 
                     render: function (data, type, row, meta){
                        <?php
                           $valHtml = '<div align="center">';
                           if($form->dataTable()->useRowDelete())
                           {
                              $rowId      = $form->dataTable()->rowDeleteData()['data-rowid'];
                              $rowCaption = $form->dataTable()->rowDeleteData()['data-rowcaption'];
                              $rowHandler = $form->dataTable()->rowDeleteData()['data-rowhandler'];
                              $valHtml   .= RowButton::delete($rowId, $rowCaption, $rowHandler)->html();
                           }

                           if($form->dataTable()->useRowEdit())
                           {
                              $rowId      = $form->dataTable()->rowEditData()['data-rowid'];
                              $rowCaption = $form->dataTable()->rowEditData()['data-rowcaption'];
                              $rowHandler = $form->dataTable()->rowEditData()['data-rowhandler'];
                              $valHtml   .= RowButton::edit($rowId, $rowCaption, $rowHandler)->html();
                           }
                           $valHtml .= '</div>';
                        ?>
                        val = '<?php echo $valHtml ?>';
                        return val;
                     }
                  },
                  { targets:'_all', searchable:true, orderable:true},
               ],
               drawCallback: this.dataTableDrawCallback
            };

            if (typeof this.fnGetDataTableOption == 'function') {
               // replace dtOption with new option
               dtOption = this.fnGetDataTableOption();
            }
            
            // instantiate DataTable
            if (dtOption != null) {
               dtTable =  $("#<?php echo $form->dataTable()->id()?>").DataTable(dtOption);
            }
            else {
               TBS.alerts.error("Invalid DataTable options");
            }

            if(dtTable != null) {
               this.dataTable = dtTable;

               <?php if( !empty($form->dataTable()->buttons()) ) { ?>
               new $.fn.dataTable.Buttons( dtTable, {
                  buttons: [
                     /*'copy', 'excel', 'pdf'*/
                     <?php
                        echo json_encode($form->dataTable()->buttons());
                     ?>
                  ]
               });

               dtTable.buttons().container().appendTo( $('.form_toolbar') );
               <?php } // !empty($form->dataTable()->buttons()) ?>
               

               // reactivate tooltip for this table
               $('a[data-toggle="tooltip"]').tooltip(
                  { 
                     placement : 'right' ,
                     animation : true,
                     offset : '1, 5'
                  }
               );

               // table and button ready on screen, apply callback now
               $('.btn_row_delete').on('click', this.fnConfirmDeleteCallback);
               $('.btn_row_edit').on('click', this.fnConfirmEditCallback);
            }
         },
      };

      function onConfirmDeleteCallback(event) {
         event.preventDefault(); // prevent to open link "#"
         var _rowid   = $(this).attr('data-rowid');
         var _caption = $(this).attr('data-rowcaption');
         var _handler = $(this).attr('data-rowhandler');

         bootbox.confirm({
            title: "<?php echo lang('Ui.deleteThisRow') ?>",
            message: "<div align='center'>" + _caption + "<br/><br/>"+" <?php echo lang('Ui.areYouSure'); ?></div>",
            closeButton: true,
            buttons: {
               cancel: {label: '<i class="fas fa-times"></i> <?php echo lang('Ui.cancel'); ?>'},
               confirm: {label: '<i class="fas fa-check"></i> <?php echo lang('Ui.ok'); ?>'}
            },
            callback: function (result) {
               if (result) {
                  if(typeof TBS.DT.fnBootboxDeleteCallback =='function') {
                     // Call user defined handler 
                     var options = {
                        rowid   : _rowid,
                        caption : _caption,
                        handler : _handler
                     };
                     TBS.DT.fnBootboxDeleteCallback(options);
                  }
                  else {
                     // Run default handler for table row delete

                     var url;
                     //if(typeof _handler !== 'undefined')
                     if (_handler) {
                        url = TBS.page.fullRequestPath + "/" + _handler;
                     }
                     else {
                        url = TBS.page.fullRequestPath + "/delete";
                     }

                     $.ajax({
                        url: url,
                        method: 'POST',
                        data: { id: _rowid , id2: ''},
                        beforeSend: function() {
                           $("body").addClass("loading");
                        },
                        complete: function() {
                           $("body").removeClass("loading");
                        },
                        success : function(response) {
                           if (response.status=='SUCCESS') {
                              location.reload(true);
                           }
                           else {
                              TBS.alerts.info("Ajax response status : " + response);
                           }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                           if (jqXHR.responseJSON != null)
                              TBS.alerts.error(jqXHR.status + " : " + jqXHR.responseJSON.message);
                           else
                              TBS.alerts.error(jqXHR.status + " : " + errorThrown);
                        },
                     });
                  }
               }
            }
         });
      }

      function onConfirmEditCallback(event) {
         event.preventDefault(); // prevent to open link "#"
         var _rowid   = $(this).attr('data-rowid');
         var _caption = $(this).attr('data-rowcaption');
         var _handler = $(this).attr('data-rowhandler');

         bootbox.confirm({
            title: "<?php echo lang('Ui.editThisRow') ?>",
            message: "<div align='center'>" + _caption +"<br/><br/>" + " <?php echo lang('Ui.areYouSure'); ?></div>",
            closeButton: true,
            buttons: {
               cancel: {label: '<i class="fas fa-times"></i> <?php echo lang('Ui.cancel'); ?>'},
               confirm: {label: '<i class="fas fa-check"></i> <?php echo lang('Ui.ok'); ?>'}
            },
            callback: function (result) {
               if (result) {
                  if(typeof TBS.DT.fnBootboxEditCallback =='function') {
                     var options = {
                        rowid   : _rowid,
                        caption : _caption,
                        handler : _handler
                     };
                     TBS.DT.fnBootboxEditCallback(options);
                  }
                  else {
                     var url;
                     if (_handler != 'NULL' ) {
                        url = TBS.page.fullRequestPath + "/" + _handler + "/" + _rowid;
                     }
                     else {
                        url = TBS.page.fullRequestPath + "/edit/" + _rowid;
                     }
                     window.location.replace(url);
                  }
               }
            }
         });
      }

   </script>

<?= $this->endSection() ?>


<?= $this->section('css') ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/DataTables-1.11.1/css/dataTables.bootstrap5.min.css' ?>"/>
   
   <?php if($form->dataTable()->useAutoFill()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/AutoFill-2.3.7/css/autoFill.bootstrap5.min.css' ?>"/>
   <?php } ?>

   <?php if($form->dataTable()->useButtons()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/Buttons-2.0.0/css/buttons.bootstrap5.min.css' ?>"/>
   <?php } ?>

   <?php if($form->dataTable()->useDateTime()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/DateTime-1.1.1/css/dataTables.dateTime.min.css' ?>"/>
   <?php } ?>

   <?php if($form->dataTable()->useFixedColumns()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/FixedColumns-3.3.3/css/fixedColumns.bootstrap5.min.css' ?>"/>
   <?php } ?>

   <?php if($form->dataTable()->useFixedHeader()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/FixedHeader-3.1.9/css/fixedHeader.bootstrap5.min.css' ?>"/>
   <?php } ?>

   <?php if($form->dataTable()->useKeyTable()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/KeyTable-2.6.4/css/keyTable.bootstrap5.min.css' ?>"/>
   <?php } ?>

   <?php if($form->dataTable()->useResponsive()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/Responsive-2.2.9/css/responsive.bootstrap5.min.css' ?>"/>
   <?php } ?>

   <?php if($form->dataTable()->useRowGroup()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/RowGroup-1.1.3/css/rowGroup.bootstrap5.min.css' ?>"/>
   <?php } ?>

   <?php if($form->dataTable()->useRowReorder()) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . '/vendor/datatables/RowReorder-1.2.8/css/rowReorder.bootstrap5.min.css' ?>"/>
   <?php } ?>

<?= $this->endSection() ?>



<?= $this->section('vendor_scripts') ?>
   
   <?php if($form->dataTable()->useJSZip()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/JSZip-2.5.0/jszip.min.js' ?>"></script>
   <?php } ?>

   <?php if($form->dataTable()->usePdfMake()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/pdfmake-0.1.36/pdfmake.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/pdfmake-0.1.36/vfs_fonts.js' ?>"></script>
   <?php } ?>
   
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/DataTables-1.11.1/js/jquery.dataTables.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/DataTables-1.11.1/js/dataTables.bootstrap5.min.js' ?>"></script>
   
   <?php if($form->dataTable()->useAutoFill()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/AutoFill-2.3.7/js/dataTables.autoFill.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/AutoFill-2.3.7/js/autoFill.bootstrap5.min.js' ?>"></script>
   <?php } ?>

   <?php if($form->dataTable()->useButtons()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/Buttons-2.0.0/js/dataTables.buttons.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/Buttons-2.0.0/js/buttons.bootstrap5.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/Buttons-2.0.0/js/buttons.colVis.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/Buttons-2.0.0/js/buttons.html5.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/Buttons-2.0.0/js/buttons.print.min.js' ?>"></script>
   <?php } ?>
   
   <?php if($form->dataTable()->useDateTime()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/DateTime-1.1.1/js/dataTables.dateTime.min.js' ?>"></script>
   <?php } ?>
   
   <?php if($form->dataTable()->useFixedColumns()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/FixedColumns-3.3.3/js/dataTables.fixedColumns.min.js' ?>"></script>
   <?php } ?>

   <?php if($form->dataTable()->useFixedHeader()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/FixedHeader-3.1.9/js/dataTables.fixedHeader.min.js' ?>"></script>
   <?php } ?>

   <?php if($form->dataTable()->useKeyTable()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/KeyTable-2.6.4/js/dataTables.keyTable.min.js' ?>"></script>
   <?php } ?>

   <?php if($form->dataTable()->useResponsive()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/Responsive-2.2.9/js/dataTables.responsive.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/Responsive-2.2.9/js/responsive.bootstrap5.min.js' ?>"></script>
   <?php } ?>

   <?php if($form->dataTable()->useRowGroup()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/RowGroup-1.1.3/js/dataTables.rowGroup.min.js' ?>"></script>
   <?php } ?>

   <?php if($form->dataTable()->useRowReorder()) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/datatables/RowReorder-1.2.8/js/dataTables.rowReorder.min.js' ?>"></script>
   <?php } ?>

   <?php if($form->dataTable()->useRowDelete() || $form->dataTable()->useRowEdit() ) { ?>
      <script type="text/javascript" src="<?php echo base_url() . '/vendor/bootbox/bootbox.min.js' ?>"></script>
   <?php } ?>
<?= $this->endSection() ?>