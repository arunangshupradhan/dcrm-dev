<?php
$routes->group('', ['namespace' => 'AdminDashboard\Controllers'], function($routes) {
    $routes->get('admin/dashboard', 'DashboardController');
});
