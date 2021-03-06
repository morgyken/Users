<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */
/** @var  \Illuminate\Routing\Router $router */
# Login
$router->get('login', ['middleware' => 'auth.guest', 'as' => 'login', 'uses' => 'AuthController@getLogin']);
$router->post('login', ['as' => 'login.post', 'uses' => 'AuthController@postLogin']);
$router->post('clinic-select', ['as' => 'clinic.post', 'uses' => 'AuthController@setClinic']);
# Register

$router->get('register', ['middleware' => 'auth.guest', 'as' => 'register', 'uses' => 'AuthController@getRegister']);
$router->post('register', ['as' => 'register.post', 'uses' => 'AuthController@postRegister']);

# Account Activation
$router->get('activate/{userId}/{activationCode}', ['uses' => 'AuthController@getActivate', 'as' => 'activate']);
# Reset password
$router->get('reset', ['as' => 'reset', 'uses' => 'AuthController@getReset']);
$router->post('reset', ['as' => 'reset.post', 'uses' => 'AuthController@postReset']);
$router->get('reset/{id}/{code}', ['as' => 'reset.complete', 'uses' => 'AuthController@getResetComplete']);
$router->post('reset/{id}/{code}', ['as' => 'reset.complete.post', 'uses' => 'AuthController@postResetComplete']);
# Logout
$router->get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
