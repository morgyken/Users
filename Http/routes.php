<?php

$namespace = 'Ignite\Users\Http\Controllers';

//back-end routes
Route::group(['prefix' => 'users',
    'middleware' => mconfig('core.core.middleware.backend'),
    'namespace' => $namespace,
    'as' => 'users.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'UsersController@index']);
    Route::get('create/user', ['as' => 'create', 'uses' => 'UsersController@create']);
    Route::post('create/users', ['as' => 'store', 'uses' => 'UsersController@store']);
    Route::get('manage/{users}/edit', ['as' => 'edit', 'uses' => 'UsersController@edit']);
    Route::put('manage/{users}/edit', ['as' => 'update', 'uses' => 'UsersController@update']);
    Route::get('manage/{users}/sendResetPassword', ['as' => 'sendResetPassword', 'uses' => 'UsersController@sendResetPassword']);
    Route::delete('manage/{users}/purge', ['as' => 'destroy', 'uses' => 'UsersController@destroy']);

    Route::get('roles', ['as' => 'role.index', 'uses' => 'RolesController@index']);
    Route::get('create/role', ['as' => 'role.create', 'uses' => 'RolesController@create']);
    Route::post('create/role', ['as' => 'role.store', 'uses' => 'RolesController@store']);
    Route::get('roles/{roles}/edit', ['as' => 'role.edit', 'uses' => 'RolesController@edit']);
    Route::put('roles/{roles}/edit', ['as' => 'role.update', 'uses' => 'RolesController@update']);
    Route::delete('roles/{roles}', ['as' => 'role.destroy', 'uses' => 'RolesController@destroy']);
});
//front -end routes
Route::group(['prefix' => 'auth',
    'middleware' => mconfig('core.core.middleware.frontend'),
    'namespace' => $namespace,
    'as' => 'public.'], function () {
    # Login
    Route::get('login', ['middleware' => 'auth.guest', 'as' => 'login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'AuthController@postLogin']);
    # Register
    /*
      Route::get('register', ['middleware' => 'auth.guest', 'as' => 'register', 'uses' => 'AuthController@getRegister']);
      Route::post('register', ['as' => 'register.post', 'uses' => 'AuthController@postRegister']);
     */
    # Account Activation
    Route::get('activate/{userId}/{activationCode}', ['uses' => 'AuthController@getActivate', 'as' => 'activate']);
    # Reset password
    Route::get('reset', ['as' => 'reset', 'uses' => 'AuthController@getReset']);
    Route::post('reset', ['as' => 'reset.post', 'uses' => 'AuthController@postReset']);
    Route::get('reset/{id}/{code}', ['as' => 'reset.complete', 'uses' => 'AuthController@getResetComplete']);
    Route::post('reset/{id}/{code}', ['as' => 'reset.complete.post', 'uses' => 'AuthController@postResetComplete']);
    # Logout
    Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
});
