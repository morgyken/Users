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
use Illuminate\Http\Request;

class AuthController extends BasePublicController {

    use DispatchesJobs;

    public function __construct() {
        parent::__construct();
    }

    public function getLogin() {
        return view('users::login');
    }

    private function default_clinic(LoginRequest $request) {
        if ($request->has('clinic')) {
            $request->session()->put('clinic', $request->clinic);
        }
    }

    public function postLogin(LoginRequest $request) {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        $remember = (bool) $request->get('remember_me', false);
        $error = $this->auth->login($credentials, $remember);
        if (!$error) {
            $this->default_clinic($request);
            flash()->success('Successfully logged in');
            $this->getClinic();
        }
        flash()->error($error);
        return redirect()->back()->withInput();
    }

    public function getClinic() {
        if (\Auth::user()->ex){
            return redirect()->route('evaluation.exdoctor.patients');
        }else{
            return view('users::clinic');
        }
    }

    public function setClinic(Request $request) {
        if ($request->has('clinic')) {
            $request->session()->put('clinic', $request->clinic);
        }
        return redirect()->route('system.dashboard');
    }


    public function getRegister() {
        return view('users::register');
    }

    public function postRegister(RegisterRequest $request) {
        app(UserRegistration::class)->register($request->all());
        flash('Your account  was created. Please login');
        return redirect()->route('public.login');
    }

    public function getLogout() {
        $this->auth->logout();
        return redirect()->route('public.login');
    }

    public function getActivate($userId, $code) {
        if ($this->auth->activate($userId, $code)) {
            flash()->success('Account activated you can now login');
            return redirect()->route('public.login');
        }
        flash()->error('There was an error with the activation');
        return redirect()->route('public.register');
    }

    public function getReset() {
        return view('users::reset.begin');
    }

    public function postReset(ResetRequest $request) {
        try {
            app(UserResetter::class)->startReset($request->all());
        } catch (UserNotFoundException $e) {
            flash()->error('No user found');
            return redirect()->back()->withInput();
        }
        flash()->success('Check email to reset password');
        return redirect()->route('public.reset');
    }

    public function getResetComplete() {
        return view('users::reset.complete');
    }

    public function postResetComplete($userId, $code, ResetCompleteRequest $request) {
        try {
            app(UserResetter::class)->finishReset(
                    array_merge($request->all(), ['userId' => $userId, 'code' => $code])
            );
        } catch (UserNotFoundException $e) {
            flash()->error('User no longer exists');
            return redirect()->back()->withInput();
        } catch (InvalidOrExpiredResetCode $e) {
            flash()->error('Invalid or expired reset code');
            return redirect()->back()->withInput();
        }
        flash()->success('Password reset');
        return redirect()->route('public.login');
    }

}
