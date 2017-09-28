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
$router->post('authenticate/user', ['as' => 'auth', 'uses' => 'AndroidController@authenticateUser']);