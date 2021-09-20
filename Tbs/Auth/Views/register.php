<?= $this->section('content') ?>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-lg-7">
                     <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4"><?=lang('Auth.createAccount')?></h3></div>
                        <div class="card-body">
                           <form>
                              <div class="row mb-3">
                                 <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                       <input class="form-control" id="inputFirstName" type="text" placeholder="<?=lang('Auth.enterFirstName')?>" />
                                       <label for="inputFirstName"><?=lang('Auth.firstName')?></label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-floating">
                                       <input class="form-control" id="inputLastName" type="text" placeholder="<?=lang('Auth.enterLastName')?>" />
                                       <label for="inputLastName"><?=lang('Auth.lastName')?></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-floating mb-3">
                                 <input class="form-control" id="inputEmail" type="email" placeholder="name@<?php echo config("\Tbs\Ui\Config\Ui")->appDomain ?>" />
                                 <label for="inputEmail"><?=lang('Auth.emailAddress')?></label>
                              </div>
                              <div class="row mb-3">
                                 <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                       <input class="form-control" id="inputPassword" type="password" placeholder="<?=lang('Auth.createAPassword')?>" />
                                       <label for="inputPassword"><?=lang('Auth.password')?></label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                       <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="<?=lang('Auth.confirmPassword')?>" />
                                       <label for="inputPasswordConfirm"><?=lang('Auth.confirmPassword')?></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="mt-4 mb-0">
                                 <div class="d-grid"><a class="btn btn-primary btn-block" href="login"><?=lang('Auth.createAccount')?></a></div>
                              </div>
                           </form>
                        </div>
                        <div class="card-footer text-center py-3">
                           <div class="small"><a href="login"><?=lang('Auth.haveAnAccount')?></a></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
<?= $this->endSection() ?>