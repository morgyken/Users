<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: iClinic
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Users\Repositories;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Ignite\Core\Contracts\Authentication;
use Ignite\Users\Events\UserHasActivatedAccount;
use Ignite\Users\Events\UserHasLoggedIn;
use Illuminate\Support\Facades\Auth;

/**
 * Description of SentinelAuthentication
 *
 * @author Samuel Dervis <samueldervis@gmail.com>
 */
class SentinelAuthentication implements Authentication {

    /**
     * Authenticate a user
     * @todo No force authenticate
     * @param  array $credentials
     * @param  bool  $remember    Remember the user
     * @return mixed
     */
    public function login(array $credentials, $remember = false) {
        try {
            if (Sentinel::authenticate($credentials, $remember)) {
                event(new UserHasLoggedIn(Sentinel::getUser()));
                return false;
            }
            return 'Invalid login or password.';
        } catch (NotActivatedException $e) {
            return 'Account not yet validated. Please check your email.';
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return "Your account is blocked for {$delay} second(s).";
        }
    }

    public function register(array $user) {
        return Sentinel::getUserRepository()->create((array) $user);
    }

    public function assignRole($user, $role) {
        return $role->users()->attach($user);
    }

    public function logout() {
        Auth::logout();
        return Sentinel::logout();
    }

    public function activate($userId, $code) {
        $user = Sentinel::findById($userId);

        $success = Activation::complete($user, $code);
        if ($success) {
            event(new UserHasActivatedAccount($user));
        }

        return $success;
    }

    public function createActivation($user) {
        return Activation::create($user)->code;
    }

    public function createReminderCode($user) {
        $reminder = Reminder::exists($user) ? : Reminder::create($user);

        return $reminder->code;
    }

    public function completeResetPassword($user, $code, $password) {
        return Reminder::complete($user, $code, $password);
    }

    public function hasAccess($permission) {
        if (!Sentinel::check()) {
            return false;
        }
        if (Sentinel::inRole('administrator')) {
            return true;
        }

        return Sentinel::hasAccess($permission);
    }

    public function check() {
        return Sentinel::check();
    }

    public function id() {
        if (!$user = $this->check()) {
            return;
        }

        return $user->id;
    }

}
