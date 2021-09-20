<!DOCTYPE html>
<html lang="<?= $page->language() ?>">
   <head>
      <?= $this->include($page->viewMeta()) ?>
        <title><?= $page->title() ?></title>
      <link href="<?php echo base_url().'/css/styles.css'; ?>" rel="stylesheet" />
        <script src="<?php echo $page->dirVendor() . "fontawesome-free/js/all.min.js"; ?>" crossorigin="anonymous"></script>
   </head>
   <body>
      <div id="layoutError">
         <div id="layoutError_content">
            <main>
               <?= $this->renderSection('content'); ?>
            </main>
         </div>
         <div id="layoutError_footer">
            <?= $this->include($page->viewFooter()) ?>
         </div>
      </div>

      <script src="<?php echo base_url()."/vendor/bootstrap/js/bootstrap.bundle.min.js"; ?>" crossorigin="anonymous"></script>
      
    </body>
</html>
