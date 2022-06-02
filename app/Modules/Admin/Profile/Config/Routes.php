<?php
$routes->group('', ['namespace' => 'AdminProfile\Controllers'], function($routes) {
    $routes->get('admin', 'LoginController::login', ['as' => 'login']);
    $routes->post('admin', 'LoginController::attemptLogin');
    $routes->get('logout', 'LoginController::logout');
    $routes->get('admin/forgot-password', 'PasswordController::forgotPassword');
    $routes->post('admin/forgot-password', 'PasswordController::attemptForgotPassword');
    $routes->get('admin/reset-password', 'PasswordController::resetPassword');
    $routes->post('admin/reset-password', 'PasswordController::attemptResetPassword');
});
