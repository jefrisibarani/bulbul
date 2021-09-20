<?= $this->extend($page->layout()) ?>
<?= $this->section('content') ?>

<?php 
   if(!empty($content_view)) 
      echo $this->include($content_view); 
?>

<?= $this->endSection() ?>