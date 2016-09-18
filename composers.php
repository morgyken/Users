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

use Ignite\Users\Composers\PermissionViewComposer;
use Ignite\Users\Composers\UsernameViewComposer;

view()->composer([ 'users::partials.permissions', 'users::partials.permissions-create',], PermissionViewComposer::class);
view()->composer(['partials.sidebar-nav', 'partials.top-nav', 'layouts.app', 'partials.*'], UsernameViewComposer::class);
