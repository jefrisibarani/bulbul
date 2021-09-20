<?php helper('form'); ?>

<form action="<?php echo base_url().$form_action ?>" method="post" id="<?php echo $form_id;?>" class="">
   <?= csrf_field() ?>
   <div class="row mt-3">
      <div class="col-sm-6">  <!-- Left Side -->
         <!-- NAMA -->
         <div class="mb-1 row">
            <label for="inputNama" class="col-sm-2 col-form-label"><?=lang('Examples.name')?></label>
            <div class="col-sm-10">
               <input name="field_nama" class="form-control form-control-sm <?php if(session('errors.field_nama')) : ?>is-invalid<?php endif ?>" 
                  id="inputNama" type="text" placeholder="" 
                  value="<?= set_value('field_nama', $data_name ?:''); ?>" disabled/>
               <div class="invalid-feedback"><?= session('errors.field_nama') ?></div>
            </div>
         </div>
         <!-- ALAMAT -->
         <div class="mb-1 row">
            <label for="inputPassword" class="col-sm-2 col-form-label"><?=lang('Examples.address')?></label>
            <div class="col-sm-10">
               <input name="field_alamat" class="form-control form-control-sm <?php if(session('errors.field_alamat')) : ?>is-invalid<?php endif ?>" 
                  id="inputPassword" type="text" placeholder=""
                  value="<?= set_value('field_alamat', $data_address ?:''); ?>" disabled/>
               <div class="invalid-feedback"><?= session('errors.field_alamat') ?></div>
            </div>
         </div>
      </div>
      
      <div class="col-sm-6">  <!-- Right side -->
         <!-- Tanggal awal-->
         <div class="mb-1 row">
            <label for="inputDateStart" class="col-sm-3 col-form-label"><?=lang('Examples.startDate')?></label>
            <div class="col-sm-9">
               <input name="field_date_start" class="form-control form-control-sm <?php if(session('errors.field_date_start')) : ?>is-invalid<?php endif ?>" 
                  id="inputDateStart" type="text" placeholder="" 
                  value="<?= set_value('field_date_start', $data_date_start ?:''); ?>" disabled/>
               <div class="invalid-feedback"><?= session('errors.field_date_start') ?></div>
            </div>
         </div>
         <!-- Tanggal akhir-->
         <div class="mb-1 row">
            <label for="inputDateEnd" class="col-sm-3 col-form-label"><?=lang('Examples.endDate')?></label>
            <div class="col-sm-9">
               <input name="field_date_end" class="form-control form-control-sm <?php if(session('errors.field_date_end')) : ?>is-invalid<?php endif ?>" 
                  id="inputDateEnd" type="text" placeholder=""
                  value="<?= set_value('field_date_end', $data_date_end ?:''); ?>" disabled/>
               <div class="invalid-feedback"><?= session('errors.field_date_end') ?></div>
            </div>
         </div>
      </div>
   </div>
</form>

<?= $this->section('scripts') ?>
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
<?= $this->endSection() ?>