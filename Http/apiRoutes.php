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

$namespace = 'Ignite\Users\Http\Controllers';

//back-end routes
Route::group(['prefix' => 'users',
    'middleware' => mconfig('core.core.middleware.api'),
    'namespace' => $namespace,
    'as' => 'users.api.'], function () {

});
