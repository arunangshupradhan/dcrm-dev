<?php
$routes->group('', ['namespace' => 'ProviderClient\Controllers'], function($routes) {
    $routes->get('service-providers/clients', 'ClientController', ['as' => 'clients']);
    $routes->match(['get', 'post'], 'service-providers/add-client', 'ClientController::addClient');
    $routes->get('service-providers/update-client/(:any)', 'ClientController::updateClient/$1');
    $routes->post('service-providers/update-client-details/(:any)', 'ClientController::updateClientDetails/$1');
    $routes->post('service-providers/update-client-auth-details/(:any)', 'ClientController::updateClientAuthDetails/$1');
});
