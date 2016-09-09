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

use Ignite\Users\Entities\Sentinel;
use Ignite\Users\Entities\User;
use Illuminate\Queue\SerializesModels;

class UserHasLoggedIn {

    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * UserHasLoggedIn constructor.
     * @param Sentinel $user
     */
    public function __construct(Sentinel $user) {
        $the_user = User::find($user->id);
        $this->user = $the_user;
    }

}
