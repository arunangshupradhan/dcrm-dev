<?php
$routes->group('', ['namespace' => 'ProviderProfile\Controllers'], function($routes) {
    #SIGN UP
    $routes->get('service-providers/sign-up', 'RegistrationController::signUp', ['as' => 'signup']);
    $routes->post('service-providers/sign-up', 'RegistrationController::attemptRegister');
    $routes->get('service-providers/activate-account', 'RegistrationController::activateAccount');

    #LOGIN & LOG OUT
    $routes->get('service-providers', 'LoginController::login', ['as' => 'providerLogin']);
    $routes->post('service-providers', 'LoginController::attemptLogin');
    $routes->get('service-providers/logout', 'LoginController::logout');

    #FORGOT PASSWORD
    $routes->get('service-providers/forgot-password', 'PasswordController::forgotPassword');
    $routes->post('service-providers/forgot-password', 'PasswordController::attemptForgotPassword');
    $routes->get('service-providers/reset-password', 'PasswordController::resetPassword');
    $routes->post('service-providers/reset-password', 'PasswordController::attemptResetPassword');
});
