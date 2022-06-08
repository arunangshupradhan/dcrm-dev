<?php
$routes->group('', ['namespace' => 'ProviderPackage\Controllers'], function($routes) {
    $routes->get('service-providers/packages', 'PackageController');
    $routes->get('service-providers/packages/check-out/(:any)', 'PaymentController::index/$1');
    $routes->post('service-providers/packages/check-out', 'PaymentController::attemptCheckout');
});
