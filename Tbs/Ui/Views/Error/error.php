<?= $this->section('content') ?>
                  <div class="container">
                     <div class="row justify-content-center">
                        <div class="col-lg-6">
                           <div class="text-center mt-4">
                              <h1 class="display-1"><?php echo $error_code; ?></h1>
                              <p class="lead"><?= $page->contentTitle() ?></p>
                              <p class="lead"><?php echo $error_message; ?></p>
                              <a href="<?php echo $error_actionLink; ?>">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    <?php echo $error_actionText; ?>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
<?= $this->endSection() ?>