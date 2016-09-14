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

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Ignite\Core\Contracts\Authentication;
use Ignite\Users\Events\UserHasRegistered;

class SendRegistrationConfirmationEmail {

    /**
     * @var AuthenticationRepository
     */
    private $auth;

    public function __construct(Authentication $auth) {
        $this->auth = $auth;
    }

    public function handle(UserHasRegistered $event) {
        $user = $event->user;

        $activationCode = $this->auth->createActivation($user);

        $data = [
            'user' => $user,
            'activationcode' => $activationCode,
        ];

        Mail::queue('users::emails.welcome', $data, function (Message $m) use ($user) {
            $m->to($user->email)->subject('Welcome.');
        }
        );
    }

}
