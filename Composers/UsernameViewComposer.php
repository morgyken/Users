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

namespace Ignite\Users\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

/**
 * Description of UsernameViewComposer
 *
 * @author samuel
 */
class UsernameViewComposer {

    public function compose(View $view) {
        $view->with('user', Auth::user());
        //  $view->with('user', $this->auth->check());
    }

}
