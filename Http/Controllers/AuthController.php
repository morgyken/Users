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

namespace Ignite\Users\Http\Controllers;

use Ignite\Core\Http\Controllers\BasePublicController;
use Ignite\Users\Exceptions\InvalidOrExpiredResetCode;
use Ignite\Users\Exceptions\UserNotFoundException;
use Ignite\Users\Http\Requests\LoginRequest;
use Ignite\Users\Http\Requests\RegisterRequest;
use Ignite\Users\Http\Requests\ResetCompleteRequest;
use Ignite\Users\Http\Requests\ResetRequest;
use Ignite\Users\Services\UserRegistration;
use Ignite\Users\Services\UserResetter;
use Illuminate\Foundation\Bus\DispatchesJobs;

class AuthController extends BasePublicController {

    use DispatchesJobs;

    public function __construct() {
        parent::__construct();
    }

    public function getLogin() {
        return view('users::login');
    }

    public function postLogin(LoginRequest $request) {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        $remember = (bool) $request->get('remember_me', false);

        $error = $this->auth->login($credentials, $remember);
        if (!$error) {
            flash()->success('Successfully logged in');

            return redirect()->intended('/core');
        }

        flash()->error($error);

        return redirect()->back()->withInput();
    }

    public function getRegister() {
        return view('user::public.register');
    }

    public function postRegister(RegisterRequest $request) {
        app(UserRegistration::class)->register($request->all());

        flash()->success(trans('user::messages.account created check email for activation'));

        return redirect()->route('register');
    }

    public function getLogout() {
        $this->auth->logout();

        return redirect()->route('login');
    }

    public function getActivate($userId, $code) {
        if ($this->auth->activate($userId, $code)) {
            flash()->success(trans('user::messages.account activated you can now login'));

            return redirect()->route('login');
        }
        flash()->error(trans('user::messages.there was an error with the activation'));

        return redirect()->route('register');
    }

    public function getReset() {
        return view('user::public.reset.begin');
    }

    public function postReset(ResetRequest $request) {
        try {
            app(UserResetter::class)->startReset($request->all());
        } catch (UserNotFoundException $e) {
            flash()->error(trans('user::messages.no user found'));

            return redirect()->back()->withInput();
        }

        flash()->success(trans('user::messages.check email to reset password'));

        return redirect()->route('reset');
    }

    public function getResetComplete() {
        return view('user::public.reset.complete');
    }

    public function postResetComplete($userId, $code, ResetCompleteRequest $request) {
        try {
            app(UserResetter::class)->finishReset(
                    array_merge($request->all(), ['userId' => $userId, 'code' => $code])
            );
        } catch (UserNotFoundException $e) {
            flash()->error(trans('user::messages.user no longer exists'));

            return redirect()->back()->withInput();
        } catch (InvalidOrExpiredResetCode $e) {
            flash()->error(trans('user::messages.invalid reset code'));

            return redirect()->back()->withInput();
        }

        flash()->success(trans('user::messages.password reset'));

        return redirect()->route('login');
    }

}
