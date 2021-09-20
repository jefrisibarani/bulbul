<?= $this->section('content') ?>
               <div class="container">
                     <div class="row justify-content-center">
                        <div class="col-lg-5">
                           <div class="card shadow-lg border-0 rounded-lg mt-5">
                                 <div class="card-header"><h3 class="text-center font-weight-light my-4"><?=lang('Auth.forgotTitle')?></h3></div>
                                 <div class="card-body">
                                    <div class="small mb-3 text-muted"><?=lang('Auth.enterEmailForInstructions')?></div>
                                    <form>
                                       <div class="form-floating mb-3">
                                          <input class="form-control" id="inputEmail" type="email" placeholder="name@<?php echo config("\Tbs\Ui\Config\Ui")->appDomain ?>" />
                                          <label for="inputEmail"><?=lang('Auth.emailAddress')?></label>
                                       </div>
                                       <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                          <a class="small" href="login"><?=lang('Auth.returnToLogin')?></a>
                                          <a class="btn btn-primary" href="login"><?=lang('Auth.resetPassword')?></a>
                                       </div>
                                    </form>
                                 </div>
                                 <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register"><?=lang('Auth.needAnAccount')?></a></div>
                                 </div>
                           </div>
                        </div>
                     </div>
               </div>
<?= $this->endSection() ?>
