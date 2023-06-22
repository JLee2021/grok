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
$routes->get('/welcome', 'Home::index');
$routes->get('/', 'Home::login');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/dashboard-trip', 'Home::dashboard_trip');
$routes->get('/new-trip', 'Home::new_trip');
$routes->get('/new-haul', 'Home::new_haul');
$routes->get('/end-haul', 'Home::end_haul');
$routes->get('/new-catch', 'Home::new_catch');
$routes->get('/log-catch', 'Home::log_catch');
$routes->post('/auth', 'Auth::index');
$routes->get('/form-links', 'Home::form_links');
$routes->get('/splash', 'Home::splash');
$routes->get('/gps', 'Home::gps');
$routes->get('/service-worker', 'Home::service_worker');
$routes->get('/dashboard-haul', 'Home::dashboard_haul');
$routes->get('/boats', 'BoatsController::index');

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
