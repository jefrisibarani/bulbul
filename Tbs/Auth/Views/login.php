<?= $this->section('content') ?>
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                           <div class="card-header"><h3 class="text-center font-weight-light my-2"><?=lang('Auth.loginTitle')?></h3></div>
                           
                           <!-- Alerts/Flashdata in page -->
                           <div id="alerts_in_page" class="alert_container d-none"></div>
                           <!-- Alerts/Flashdata inside form -->
                           <div id="alerts_in_form" class="alert_container d-none"></div>

                           <div class="card-body">
                              <form action="<?= route_to('login') ?>" method="post">
                                 <?= csrf_field() ?>
                                 <div class="form-floating mb-2">
                                    <input name="loginName" class="form-control form-control-sm <?php if(session('errors.loginName')) : ?>is-invalid<?php endif ?>" id="inputLoginname" type="text" placeholder="admin@<?php echo config("\Tbs\Ui\Config\Ui")->appDomain ?>" />
                                    <label for="inputLoginname"><?=lang('Auth.username')?></label>
                                    <div class="invalid-feedback"><?= session('errors.loginName') ?></div>
                                 </div>
                                 <div class="form-floating mb-2">
                                    <input name="password" class="form-control form-control-sm <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" id="inputPassword" type="password" placeholder="Password" />
                                    <label for="inputPassword"><?=lang('Auth.password')?></label>
                                    <div class="invalid-feedback"><?= session('errors.password') ?></div>
                                 </div>
                                 <div class="form-check mb-2">
                                    <input class="form-check-input" id="inputRememberMe" type="checkbox" value="" />
                                    <label class="form-check-label" for="inputRememberMe"><?=lang('Auth.rememberMe')?></label>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="<?php echo base_url()."/forgotpassword"?>"><?=lang('Auth.forgotPassword')?></a>
                                    <!--a class="btn btn-primary" href="<?php //echo base_url()."/home"?>"><?=lang('Auth.loginAction')?></a-->
                                    <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.loginAction')?></button>
                                 </div>
                              </form>
                           </div>
                           <!--div class="card-footer text-center py-3">
                              <div class="small"><a href="<?php //echo base_url()."/register"?>"><?=lang('Auth.register')?></a></div>
                           </div-->
                        </div>
                     </div>
                  </div>
               </div>
<?= $this->endSection() ?>
