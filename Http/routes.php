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

$router->get('/', ['as' => 'index', 'uses' => 'UsersController@index']);
$router->get('create/user', ['as' => 'create', 'uses' => 'UsersController@create_users']);
$router->post('create/users', ['as' => 'store', 'uses' => 'UsersController@store']);
$router->get('manage/{user}/edit', ['as' => 'edit', 'uses' => 'UsersController@edit']);
$router->put('manage/{user}/edit', ['as' => 'update', 'uses' => 'UsersController@update']);
$router->get('manage/{user}/sendResetPassword', ['as' => 'sendResetPassword', 'uses' => 'UsersController@sendResetPassword']);
$router->delete('manage/{user}/purge', ['as' => 'destroy', 'uses' => 'UsersController@destroy']);

$router->get('roles', ['as' => 'role.index', 'uses' => 'RolesController@index']);
$router->get('create/role', ['as' => 'role.create', 'uses' => 'RolesController@create']);
$router->post('create/role', ['as' => 'role.store', 'uses' => 'RolesController@store']);
$router->get('roles/{roles}/edit', ['as' => 'role.edit', 'uses' => 'RolesController@edit']);
$router->put('roles/{roles}/edit', ['as' => 'role.update', 'uses' => 'RolesController@update']);
$router->delete('roles/{roles}', ['as' => 'role.destroy', 'uses' => 'RolesController@destroy']);

$router->match(['get', 'post'], 'user_groups', ['uses' => 'RolesController@user_groups', 'as' => 'user_groups']);
$router->get('permissions/{group}/edit', ['as' => 'permissions', 'uses' => 'RolesController@edit']);
$router->post('permissions/{group}/update', ['as' => 'permissions.update', 'uses' => 'RolesController@update']);
