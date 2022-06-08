<?php
$routes->group('', ['namespace' => 'ProviderProfile\Controllers'], function($routes) {

    $routes->get('service-providers/sign-up', 'RegistrationController::signUp', ['as' => 'signup']);
    $routes->post('service-providers/sign-up', 'RegistrationController::attemptRegister');
    $routes->get('service-providers/activate-account', 'RegistrationController::activateAccount');
    $routes->get('service-providers', 'LoginController::login', ['as' => 'providerLogin']);
});
