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

namespace Ignite\Users\Providers;

use Ignite\Events\Handlers\UserLoggedInListener;
use Ignite\Users\Events\Handlers\SendRegistrationConfirmationEmail;
use Ignite\Users\Events\Handlers\SendResetCodeEmail;
use Ignite\Users\Events\RoleWasUpdated;
use Ignite\Users\Events\UserHasBegunResetProcess;
use Ignite\Users\Events\UserHasLoggedIn;
use Ignite\Users\Events\UserHasRegistered;
use Ignite\Users\Events\UserWasUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Maatwebsite\Sidebar\Domain\Events\FlushesSidebarCache;

class EventServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    protected $listen = [
        UserHasRegistered::class => [
            SendRegistrationConfirmationEmail::class,
        ],
        UserHasBegunResetProcess::class => [
            SendResetCodeEmail::class,
        ],
        UserWasUpdated::class => [
            FlushesSidebarCache::class,
        ],
        RoleWasUpdated::class => [
            FlushesSidebarCache::class,
        ],
        UserHasLoggedIn::class => [
            UserLoggedInListener::class,
        ]
    ];

}
