<?php
$routes->group('', ['namespace' => 'ProviderPackage\Controllers'], function($routes) {
    $routes->get('service-providers/packages', 'PackageController');
});
