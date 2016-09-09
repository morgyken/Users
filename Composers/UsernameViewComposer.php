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
use Ignite\Core\Contracts\Authentication;

/**
 * Description of UsernameViewComposer
 *
 * @author samuel
 */
class UsernameViewComposer {

    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(Authentication $auth) {
        $this->auth = $auth;
    }

    public function compose(View $view) {
        $view->with('user', $this->auth->check());
    }

}
