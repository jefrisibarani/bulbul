            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
               <div class="sb-sidenav-menu">
                  <div class="nav">

                     <!-- Core group ====================================================================-->
                     <div class="sb-sidenav-menu-heading">Core</div>
                     <a class="nav-link" href="/">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                     </a>
                     <!-- /Core group ===================================================================-->


                     <!-- APP group =====================================================================-->
                     <div class="sb-sidenav-menu-heading"><?= lang('Front.app') ?></div>
                     <!-- First Sample Menu --------------------------------------------------------------->
                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFirstMenu" aria-expanded="false" aria-controls="collapseFirstMenu">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        <?= lang('Front.FirstSample') ?>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <!-- First Sample submenu -->
                     <div class="collapse" id="collapseFirstMenu" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link" href="#"><?= lang('Front.FirstSampleA') ?></a>
                           <a class="nav-link" href="#"><?= lang('Front.FirstSampleB') ?></a>
                           <a class="nav-link" href="#"><?= lang('Front.FirstSampleC') ?></a>
                           <a class="nav-link" href="#"><?= lang('Front.FirstSampleD') ?></a>
                        </nav>
                     </div>
                     <!-- /First Sample Menu -------------------------------------------------------------->

                     <!-- Second Sample Menu -------------------------------------------------------------->
                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSecondMenu" aria-expanded="false" aria-controls="collapseSecondMenu">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        <?= lang('Front.SecondSample2') ?>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <!-- Second Sample Menu submenu -->
                     <div class="collapse" id="collapseSecondMenu" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link" href="#"><?= lang('Front.SecondSample2A') ?></a>
                           <a class="nav-link" href="#"><?= lang('Front.SecondSample2B') ?></a>
                           <a class="nav-link" href="#"><?= lang('Front.SecondSample2C') ?></a>
                           <a class="nav-link" href="#"><?= lang('Front.SecondSample2D') ?></a>
                        </nav>
                     </div>
                     <!-- /Second Sample Menu Menu -------------------------------------------------------->



                     <!-- Pages menu ---------------------------------------------------------------------->
                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        <?= lang('Ui.uiPages') ?>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <!-- Pages submenus -->
                     <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                           
                           <!-- Pages submenus Authentication-->
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                              Authentication
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                           </a>
                           <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                 <a class="nav-link" href="<?= route_to('login') ?>">           <?=lang('Auth.loginTitle')?></a>
                                 <a class="nav-link" href="<?= route_to('register') ?>">        <?=lang('Auth.createAccount')?></a>
                                 <a class="nav-link" href="<?= route_to('forgotpassword') ?>">  <?=lang('Auth.forgotTitle')?></a>
                              </nav>
                           </div>
                           <!-- /Pages submenus Authentication -->

                           <!-- Pages submenus Error -->
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                              Error
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                           </a>
                           <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                 <a class="nav-link" href="<?php echo base_url().'/error/401'; ?>">401 Page</a>
                                 <a class="nav-link" href="<?php echo base_url().'/error/404'; ?>">404 Page</a>
                                 <a class="nav-link" href="<?php echo base_url().'/error/500'; ?>">500 Page</a>
                              </nav>
                           </div>
                           <!-- /Pages submenus Error -->
                           
                           <!-- Pages submenus Tutorial -->
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseTutorial" aria-expanded="false" aria-controls="pagesCollapseTutorial">
                              <?=lang('Tutorial.tutorial')?>
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                           </a>
                           <div class="collapse" id="pagesCollapseTutorial" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav"> 
                                 <a class="nav-link" href="<?php echo base_url().'/tutorial' ?>"><?=lang('Tutorial.index')?></a>
                                 <a class="nav-link" href="<?php echo base_url().'/tutorial/page_basic_page' ?>"><?=lang('Tutorial.page_basic_page')?></a>
                                 <a class="nav-link" href="<?php echo base_url().'/tutorial/page_basic_page_data' ?>"><?=lang('Tutorial.page_basic_page_data')?></a>
                                 <a class="nav-link" href="<?php echo base_url().'/tutorial/page_basic_content' ?>"><?=lang('Tutorial.page_basic_content')?></a>
                                 <a class="nav-link" href="<?php echo base_url().'/tutorial/page_basic_form' ?>"><?=lang('Tutorial.page_basic_form')?></a>
                                 <a class="nav-link" href="<?php echo base_url().'/tutorial/page_basic_form2' ?>"><?=lang('Tutorial.page_basic_form2')?></a>
                                 <a class="nav-link" href="<?php echo base_url().'/tutorial/page_basic_form3' ?>"><?=lang('Tutorial.page_basic_form3')?></a>
                                 <a class="nav-link" href="<?php echo base_url().'/tutorial/page_basic_formtable' ?>"><?=lang('Tutorial.page_basic_formtable')?></a>
                              </nav>
                           </div>
                           <!-- /Pages submenus Tutorial -->

                           <!-- Pages submenus Examples -->
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseExample" aria-expanded="false" aria-controls="pagesCollapseExample">
                              <?=lang('Examples.examples')?>
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                           </a>
                           <div class="collapse" id="pagesCollapseExample" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav"> 
                                 <a class="nav-link" href="<?= route_to('examples') ?>"><?=lang('Examples.index')?></a>
                                 <a class="nav-link" href="<?= route_to('examples/page_basic_page') ?>"><?=lang('Examples.page_basic_page')?></a>
                                 <a class="nav-link" href="<?= route_to('examples/page_basic_page_data') ?>"><?=lang('Examples.page_basic_page_data')?></a>
                                 <a class="nav-link" href="<?= route_to('examples/page_basic_content') ?>"><?=lang('Examples.page_basic_content')?></a>
                                 <a class="nav-link" href="<?= route_to('examples/page_basic_form') ?>"><?=lang('Examples.page_basic_form')?></a>
                                 <a class="nav-link" href="<?= route_to('examples/page_basic_form2') ?>"><?=lang('Examples.page_basic_form2')?></a>
                                 <a class="nav-link" href="<?= route_to('examples/page_basic_form3') ?>"><?=lang('Examples.page_basic_form3')?></a>
                                 <a class="nav-link" href="<?= route_to('examples/page_basic_formtable') ?>"><?=lang('Examples.page_basic_formtable')?></a>
                              </nav>
                           </div>
                           <!-- Pages submenus Examples -->

                        </nav>
                     </div>
                     <!-- /Pages -------------------------------------------------------------------------->
                     <!-- /APP group ====================================================================-->



                     <!-- REPORT group ==================================================================-->
                     <div class="sb-sidenav-menu-heading">Report</div>
                     <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Report A
                     </a>
                     <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Report B
                     </a>
                     <!-- /REPORT group =================================================================-->

                  </div> <!-- /nav -->
               </div> <!-- sb-sidenav-menu -->


               <?php 
               $auth = service("authentication");
               if( $auth->isLoggedIn())
               {
               ?>

               <div class="sb-sidenav-footer">
                  <div class="small">Logged in as:</div>
                  <?php echo $auth->identity()->fullName; ?>
               </div>

               <?php } ?>


            
            </nav> <!-- sb-sidenav accordion -->