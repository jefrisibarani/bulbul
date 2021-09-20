      <script type="text/javascript">

         <?php
         $auth                    = service('authentication');
         $debug                   = 'true';
         $loggedIn                = $auth->isLoggedIn() ? 'true' : 'false';

         if($page instanceof \Tbs\Ui\Page)
         {
            $sessionExpNotice     = $page_sessionExpNotice ? 'true': 'false';
            $sessionTimeout       = $page_sessionTimeout / MINUTE;
         }

         $varTBS = 
         'var TBS = {
            theme: "'            . $page_theme . '",
            baseUrl: "'          . base_url(). '",
            controller: "'       . $page->controllerName(). '",
            language: "'         . $page_language. '",
            page : {
               requestPath: "'   . $page->request()->getPath().'",
               fullRequestPath: "'.base_url().'/'.$page->request()->getPath().'",
            },
            loggedin: '          . $loggedIn . ',
            debug: '             . $debug . ',';

         if($page instanceof \Tbs\Ui\Page)
         {
            $varTBS .= 
            'sessionExpNotice: '       . $sessionExpNotice . ',
            sessionTimeout: '       . $sessionTimeout . ',';
         }
         $varTBS .= '};';
         echo $varTBS;
         echo "\n";
         ?>
         function TBS_LOG(arg) {if (TBS.debug) console.log( "DBG : " + arg ); };

      </script>