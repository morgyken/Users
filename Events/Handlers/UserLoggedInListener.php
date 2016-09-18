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

namespace Ignite\Users\Events\Handlers;

use Ignite\Users\Events\UserHasLoggedIn;
use Illuminate\Support\Facades\Auth;

class UserLoggedInListener {

    /**
     * Handle the event.
     *
     * @param UserHasLoggedIn $event
     * @return void
     */
    public function handle(UserHasLoggedIn $event) {
        Auth::login($event->user);
    }

}
