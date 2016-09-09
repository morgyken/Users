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

namespace Ignite\Users\Events;

class UserWasUpdated {

    public $user;

    public function __construct($user) {
        $this->user = $user;
    }

}
