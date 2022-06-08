<?php
$routes->group('', ['namespace' => 'ProviderDashboard\Controllers'], function($routes) {
    $routes->get('service-providers/dashboard', 'DashboardController');
});
