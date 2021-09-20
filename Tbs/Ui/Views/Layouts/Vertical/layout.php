<!DOCTYPE html>
<html lang="<?= $page->language() ?>">
   <head>
      <?= $this->include($page->viewMeta()) ?>
      <title><?= $page->title() ?></title>
      <script src="<?php echo $page->dirVendor() . "fontawesome-free/js/all.min.js"; ?>" crossorigin="anonymous"></script>
      <?= $this->include($page->viewCssCore()) ?>
      <?= $this->include($page->viewCssTheme()) ?>
      <?= $this->renderSection('css') ?>
      <?= $this->include($page->viewJsTbs()) ?>
   </head>
   <body id="page-top" class="sb-nav-fixed" >
      <?= $this->include($page->viewHeader()) ?>
      <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
               <?= $this->include($page->viewSidebar()) ?>
            </div>
            <div id="layoutSidenav_content">
               <main id="<?= $page->id() ?>">
                  <div class="container-fluid px-4">
                     <h2 class="mt-2"><?= $page->contentTitle() ?></h2>
                     
                     <!-- Breadcrumbs-->
                     <?php echo $page->breadcrumb()->html() ?>

                     <!-- Alerts/Flashdata in page -->
                     <div id="alerts_in_page" class="alert_container d-none"></div>
                     <!-- Page Content -->
                     <?= $this->renderSection('content') ?>
                  </div>
               </main>
               <?= $this->include($page->viewFooter()) ?>
            </div>
      </div>
      <!-- Scroll to Top Button-->
      <a id="scroll_to_top" class="rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
      <!-- Alerts/Flashdata in toast -->
      <div id="alerts_in_toast" class="alert_container"></div>
      <div id="session_counter" class="bg-info text-danger"></div>
      <!-- Ajax running indicator -->
      <div id="modal_loader"></div>	
      <!-- Core Javascripts -->
      <?= $this->include($page->viewJsCore()) ?>
      <?= $this->renderSection('vendor_scripts') ?>
      <?= $this->include($page->viewJsAlert()) ?>
      <?= $this->include($page->viewJsSite()) ?> 
      <?= $this->renderSection('scripts') ?>
   </body>
</html>
