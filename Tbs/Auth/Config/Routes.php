<?php
/**
 * @author jefrisibarani@gmail.com
 */

$routes->group('', ['namespace' => 'Tbs\Auth\Controllers'], function ($routes) {

   $routes->get('login',            'AuthController::login',          ['as' => 'login']);
   $routes->post('login',           'AuthController::attemptLogin');
   $routes->get('logout',           'AuthController::logout');
   $routes->get('forgotpassword',   'AuthController::forgotPassword');
   $routes->get('register',         'AuthController::register');
});
