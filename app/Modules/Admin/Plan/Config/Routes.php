<?php
$routes->group('', ['namespace' => 'AdminPlan\Controllers'], function($routes) {
    $routes->get('admin/plan', 'PlanController', ['as' => 'plan']);
    $routes->post('admin/plan/add-plan','PlanController::addPlan');
    $routes->post('admin/plan/add-plan/(:num)','PlanController::addPlan/$1');
    $routes->get('admin/plan/delete-plan/(:any)','PlanController::deletePlan/$1');
    $routes->post('admin/plan/get-plan', 'PlanController::ajaxGetPlan');
});
