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
                  value="<?= set_value('field_nama', $data_name ?:''); ?>"/>
               <div class="invalid-feedback"><?= session('errors.field_nama') ?></div>
            </div>
         </div>
         <!-- ALAMAT -->
         <div class="mb-1 row">
            <label for="inputPassword" class="col-sm-2 col-form-label"><?=lang('Examples.address')?></label>
            <div class="col-sm-10">
               <input name="field_alamat" class="form-control form-control-sm <?php if(session('errors.field_alamat')) : ?>is-invalid<?php endif ?>" 
                  id="inputPassword" type="text" placeholder=""
                  value="<?= set_value('field_alamat', $data_address ?:''); ?>"/>
               <div class="invalid-feedback"><?= session('errors.field_alamat') ?></div>
            </div>
         </div>
      </div>
      
      <div class="col-sm-6">  <!-- Right side -->
      </div>   
   </div>
</form>
