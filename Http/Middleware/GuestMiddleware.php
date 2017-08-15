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

namespace Ignite\Users\Http\Middleware;

use Closure;
use Ignite\Core\Contracts\Authentication;

class GuestMiddleware {

    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(Authentication $auth) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            return redirect()->route('system.dashboard');
        }
        return $next($request);
    }

}
