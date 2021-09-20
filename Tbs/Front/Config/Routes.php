<?php
/**
 * @author jefrisibarani@gmail.com
 */

$routes->group('', ['namespace' => 'Tbs\Front\Controllers'], function ($routes) {
   $routes->get('dashboard',                 'DashboardController::index',        ['as' => 'dashboard']);
});