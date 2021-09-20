<script type="text/javascript">

   // SB Admin v7.0.3
   window.addEventListener('DOMContentLoaded', event => {
      // Toggle the side navigation
      const sidebarToggle = document.body.querySelector('#sidebarToggle');
      if (sidebarToggle) {
         // Uncomment Below to persist sidebar toggle between refreshes
         // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
         //    document.body.classList.toggle('sb-sidenav-toggled');
         // }
         sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
         });
      }
   });

   // TBS site script
   "use strict";
   $(function()
   {
      // Scroll to top button appear
      $(document).on('scroll', function() {
         //var scrollToTop = document.getElementById("scroll_to_top");
         var scrollDistance = $(this).scrollTop();
         if (scrollDistance > 100) {
            $('#scroll_to_top').fadeIn();
         } else {
            $('#scroll_to_top').fadeOut();
         }
      });

      // Smooth scrolling using jQuery easing
      $(document).on('click', 'a#scroll_to_top', function(event) {
         var $anchor = $(this);
         $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
         }, 1000, 'easeInOutExpo');
         event.preventDefault();
      });


      /* Activate tooltip */
      $('[data-toggle="tooltip"]').tooltip({
            placement : 'right',
            animation : true,
            offset : '1, 5'
         }
      );


      $('[aria-describedby="btnNavbarSearch"]').parent().parent().submit(function (evt) {
         evt.preventDefault();
      }); 

      // Show last sidebar menu
      var collapsibles = document.getElementsByClassName('collapse');
         [].forEach.call(collapsibles, function(item) {
         item.addEventListener('shown.bs.collapse', function (event) {
            var id = event.target.id;
            localStorage.setItem('lastSidebarMenu', id);
         });
      });

      var lastSidebarMenuId = localStorage.getItem('lastSidebarMenu');
      if(lastSidebarMenuId) {
         showSidebarMenu(lastSidebarMenuId);
      }

   });


   function finishAjax(id){
         $('#loader').remove();
         $('#bagian').show();
   };

   $(document).ajaxStart(function(e, xhr, settings){
      var _e = e;
      var _xhr = xhr;
      var _set = settings;
      TBS_LOG( "ajaxStart handler triggered" );
   });

   $(document).ajaxComplete(function(e, xhr, settings){
      var _e = e;
      var _xhr = xhr;
      var _set = settings;
      TBS_LOG("ajaxComplete handler triggered" );
   });

   function submitForm(formId)
   {
      TBS_LOG("Button Save handler from site.js - submitForm: " + formId );
     
      if ( $('#uiBtnSubmitHidden').length > 0 ) {       // if hidden submit button exists
         $('#uiBtnSubmitHidden').trigger('click');      // simulate click, let html5 validation works
      }
      else {
         var _form = document.getElementById(formId);
         _form.submit();                            // just submit the form, server side validation will take over
      }

      return false;
   }

   function showAjaxCallError(e,autoClose=true) {
      var errMsg = '';
      if(e.status == 401) {
         try {
            var resp = JSON.parse(e.responseText);
            errMsg = 'Error : ' + e.status + ', ' + resp.data;
         }
         catch(err) {
            errMsg = e.responseText;
         }
      }
      else if(e.status == 200) {
         errMsg = 'Error : ' + e.responseText;
      }
      else
         errMsg = "Error communicating with backend";

      $("#modal_loader").hide();
      TBS.alerts.error(errMsg,'Toast','',autoClose);
   };


   function showSidebarMenu(id)
   {
      var collapsible = document.getElementById(id);
      TBS_LOG("showSidebarMenu " + id );

      var parentId    = collapsible.getAttribute("data-bs-parent");
      if (parentId)
      {
         parentId   = parentId.substr(1,parentId.length-1);
         var parent =  document.getElementById(parentId);
         if(parent)
         {
            TBS_LOG("showSidebarMenu " + parentId );
            showSidebarMenu(parentId);
         }
      }
      var bsCollapse = new bootstrap.Collapse(collapsible, {show: true});
   }


</script>