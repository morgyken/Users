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

use Ignite\Core\Contracts\Authentication;
use Ignite\Core\Http\Controllers\AdminBaseController;
use Ignite\Core\Library\PermissionManager;
use Ignite\Users\Repositories\RoleRepository;
use Ignite\Users\Repositories\UserRepository;

class UsersController extends AdminBaseController {

    /**
     * @var UserRepository
     */
    private $user;

    /**
     * @var RoleRepository
     */
    private $role;

    /**
     * @var Authentication
     */
    private $auth;
    protected $data = [];

    /**
     * @param PermissionManager $permissions
     * @param UserRepository    $user
     * @param RoleRepository    $role
     * @param Authentication    $auth
     */
    public function __construct(PermissionManager $permissions, UserRepository $user, RoleRepository $role, Authentication $auth) {
        parent::__construct();
        $this->permissions = $permissions;
        $this->user = $user;
        $this->role = $role;
        $this->auth = $auth;
    }

    public function index() {
        $this->data['users'] = $this->user->all();
        $this->data['user'] = $this->auth->check();
        return view('users::index', ['data' => $this->data]);
    }

}
