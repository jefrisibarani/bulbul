<!DOCTYPE html>
<html lang="en">
   <head>
      <?= $this->include($page->viewMeta()) ?>
      <title><?= $page->title() ?></title>
      <?= $this->include($page->viewCssCore()) ?>
      <?= $this->renderSection('css') ?>
      <?= $this->include($page->viewJsTbs()) ?>
   </head>
   <body class="bg-primary">
      <div id="layoutAuthentication">
         <div id="layoutAuthentication_content">
            <main>
               <?= $this->renderSection('content'); ?>
            </main>
         </div>
         <div id="layoutAuthentication_footer">
            <?= $this->include($page->viewFooter()) ?>
         </div>
      </div>
      <!-- Core Javascripts -->
      <script src="<?php echo $page->dirVendor() . "jquery/jquery.min.js"; ?>" crossorigin="anonymous"></script>
      <script src="<?php echo $page->dirVendor()  . "bootstrap/js/bootstrap.bundle.min.js"; ?>" crossorigin="anonymous"></script>

      <?= $this->include($page->viewJsAlert()) ?> 
      <?= $this->renderSection('scripts') ?>
   </body>
</html>
