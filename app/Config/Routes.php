<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('users', 'Users::index', ['filter' => 'noauth']);
$routes->get('registro','Users::register', ['filter' => 'noauth']);
$routes->get('users/register','Users::register', ['filter' => 'noauth']);
$routes->get('admin/login','Admin::login', ['filter' => 'noauth']);

$routes->group('home', ['filter' => 'auth:user'], function($routes){
  $routes->add('forms', 'Home::forms');
  $routes->add('briefing', 'Home::briefing');
});

$routes->group('users', ['filter' => 'auth:user'], function($routes){
  $routes->add('profile', 'Users::profile');
  $routes->add('forms', 'Users::forms');
});

$routes->group('admin', ['filter' => 'auth:admin'], function($routes){
  $routes->add('', 'Admin::index');
  $routes->add('index', 'Admin::index');
  $routes->add('users', 'Admin::users');
  $routes->add('applications', 'Admin::applications');
  $routes->add('password', 'Admin::password');
  $routes->add('register', 'Admin::register');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
