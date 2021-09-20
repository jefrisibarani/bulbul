      <div class="row">
         <div id="toolbar_container" class="col form_toolbar">
         
         <?php if(!empty($form_search)){ ?>
            <span class="d-none" id="searchFormWrap">
               <form id="baseSearchForm" class="form-inline" action="<?=route_to('search/top') ?>" method="post">
                  <?= csrf_field() ?>
                  <input id="baseSearchInput" type="text"  value="" name="inputSearch" class="form-control"/>
                  <input id="baseFilterInput1" type="text" value="" name="inputFilter[]" class="form-control"/>
                  <input id="baseFilterInput2" type="text" value="" name="inputFilter[]" class="form-control"/>
                  <input id="baseFilterInput3" type="text" value="" name="inputFilter[]" class="form-control"/>
                  <input id="baseFilterInput4" type="text" value="" name="inputFilter[]" class="form-control"/>
                  <input id="searchButton" type="image" value="Cari" src="<?php echo $page->imgDir() .'button_search.jpg'; ?>" />
               </form>
            </span>
         <?php } ?>
         
         <?php
            $toolbarData = $page->toolbar()->data();
            $toolbar_buttons = $toolbarData['toolbar_buttons'];
            if(!empty($toolbar_buttons))
            {
               foreach ($toolbar_buttons as $btn)
               {
                  echo $btn->html();
               }
            }

            if(!empty($form_filter)) {
               $this->include($page->partCommon('form_filter')); 
            }

            if(!empty($form_paging)) {
               $this->include($page->partCommon('form_paging')); 
            }

         ?>

         </div> <!-- Form toolbar -->
      </div>
