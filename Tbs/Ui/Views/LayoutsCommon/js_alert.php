      <!-- Alerts Js -->
      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
         <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
         </symbol>
         <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
         </symbol>
         <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
         </symbol>
      </svg>

      <script type="text/javascript">
         var showAlert = function (options) {
            var alertType = options.alertType;
            var message   = options.message;
            var location  = options.location;
            var alertId   = options.alertId;
            var autoClose = options.autoClose;

            var iconClass = "d-flex justify-content-between";
            //iconClass = "";
            var iconId    = "#info-fill";
            var iconLabel = "";

            if (alertType == "alert-success") {
               iconId = "check-circle-fill";
               iconLabel = "Success:";
            }
            if (alertType == "alert-info") {
               iconId = "info-fill";	
               iconLabel = "Info:";
            }
            if (alertType == "alert-warning") {
               iconId = "exclamation-triangle-fill";	
               iconLabel = "Warning:";
            }
            if (alertType == "alert-danger") {
               iconId = "exclamation-triangle-fill";
               iconLabel = "Danger:";
            }
            var svgIcon   = `<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="${iconLabel}:"><use xlink:href="#${iconId}"/></svg>`;
            //svgIcon = "";
            var element = `
                     <div id="${alertId}" class="alert ${alertType} ${iconClass} alert-dismissable fade show" role="alert">
                        ${svgIcon}
                        <span>${message}</span>
                        <button type="button" class="btn-close align-right" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>`;
            
            var alertElement = null;

            if (location === 'Toast') {
               $("#alerts_in_toast").append(element);
               alertElement = $("#alerts_in_toast div").last();
            }
            else if(location ==='Page') {
               $("#alerts_in_page").append(element);
               alertElement = $("#alerts_in_page div").last();
            }
            else if (location === 'Form') {
               $("#alerts_in_form").append(element);
               alertElement = $("#alerts_in_form div").last();
            }

            if(autoClose) {
               alertElement.delay(300).fadeIn().delay(6000).fadeOut("normal", function() {
                  $(this).trigger('alertFadeOutEvent', options);
                  var bsAlert = new bootstrap.Alert(alertElement);
                  bsAlert.close();
               });

            } else {
               alertElement.delay(300).fadeIn();
            }
         };


         $(function() {
            TBS.alerts = {
               show: showAlert,
               success: function (message, location = 'Toast', alertId = '', autoClose = true) { showAlert({ alertType: "alert-success",	message: message, location: location, alertId: alertId, autoClose: autoClose }); },
               info:    function (message, location = 'Toast', alertId = '', autoClose = true) { showAlert({ alertType: "alert-info",		message: message, location: location, alertId: alertId, autoClose: autoClose }); },
               warning: function (message, location = 'Toast', alertId = '', autoClose = true) { showAlert({ alertType: "alert-warning",	message: message, location: location, alertId: alertId, autoClose: autoClose }); },
               error:   function (message, location = 'Toast', alertId = '', autoClose = true) { showAlert({ alertType: "alert-danger",	message: message, location: location, alertId: alertId, autoClose: autoClose }); },
            };

            if ($("#alerts_in_form").length) {
               $('#alerts_in_form').removeClass("d-none");
            }
            if ($("#alerts_in_page").length) {
               $('#alerts_in_page').removeClass("d-none");
            }
            
            $('.alert_container').on('alertFadeOutEvent', function(e,opt) {
               var id = e.target.id;
               TBS_LOG("Alert Id:" + id + " has been closed ");
               /*
               if (typeof TBS != 'undefined')
               {
                  // validation error messages
                  if(id.startsWith("validation_") || id == '')
                     return;
                  
                  // alert messages
                  var baseUrl = TBS.baseUrl;
                  if (baseUrl) {
                     var url = baseUrl + "front/remove_alert/" + id ;
                     TBS_LOG( "posting remove_alert : " + url);
                     $.post(url);
                  }
               }
               */
            });

         <?php 
            $alertSvc = service('alert');
            if( ! $alertSvc->isEmpty() ) 
            {
               $alerts = $alertSvc->getAlerts();
               foreach ($alerts as $key => $value) 
               {
                  $alertMsg = $value['message'];
                  $alertMsg = str_replace(array("\r\n", "\n", "\r"), ' ', $alertMsg);
                  echo '
               TBS.alerts.show({
                  message: "'. addslashes($alertMsg) . '",
                  alertType: "'.$value['type'] .'",
                  location: "' .$value['location'] .'",
                  alertId: "'  .$value['alertId'] .'",
                  autoClose: ' .$value['autoClose'] .'
               });';
               }

               $alertSvc->removeAlerts();
            }
            
            // validation error does not have an alert Id, so create it!
            $validationErrors = service('validation')->getErrors();
            if ( !empty($validationErrors) )
            {
               $messages = $validationErrors;
               echo "\n";
               foreach ($messages as $msg)
               {
                  $msg = str_replace(array("\r\n", "\n", "\r"), ' ', $msg);
                  //$msg = htmlentities($msg);
                  $msg = addslashes($msg);
                  $id  = "validation_" . bin2hex(random_bytes(8));
                  echo 'TBS.alerts.error("'. $msg . '","Form", "'. $id .'");';
                  echo "\n";
               }
            }
         ?>
         });
      </script>
