<?php
/**
 * @author jefrisibarani@gmail.com
 */

use CodeIgniter\Exceptions\PageNotFoundException;

// Prevent access to PageController
$routes->add('PageController(:any)', function () {
   throw PageNotFoundException::forPageNotFound();
});

// Prevent access to PagebasicController
$routes->add('PagebasicController(:any)', function () {
   throw PageNotFoundException::forPageNotFound();
});

$routes->group('', ['namespace' => 'Tbs\Ui\Controllers'], function ($routes) {
   $routes->get('error/(:num)',              'ErrorController::index/$1',);
});

$routes->group('examples', ['namespace' => 'Tbs\Ui\Controllers'], function ($routes) {
   $routes->get('',                          'ExamplesController::index');

   $routes->get('page_variables',            'ExamplesController::page_variables');
   $routes->get('page_layout_basic_content', 'ExamplesController::pageLayoutBasicContent');
   $routes->get('page_layout_form',          'ExamplesController::pageLayoutForm');

   $routes->get('page_basic_page',           'ExamplesController::basicPage');
   $routes->get('page_basic_page_data',      'ExamplesController::basicPageData');
   $routes->get('page_basic_content',        'ExamplesController::basicContent');
   $routes->get('page_basic_form',           'ExamplesController::basicForm');
   $routes->get('page_basic_form2',          'ExamplesController::basicForm2');
   $routes->get('page_basic_form3',          'ExamplesController::basicForm3');
   $routes->get('page_basic_formtable',      'ExamplesController::basicFormTable');

   $routes->post('page_basic_form3_post',    'ExamplesController::basicForm3Post');
});

$routes->group('tutorial', ['namespace' => 'Tbs\Ui\Controllers'], function ($routes) {
   $routes->get('',                          'TutorialController::index',);
   $routes->get('(:segment)',                'TutorialController::showPage/$1');
});

