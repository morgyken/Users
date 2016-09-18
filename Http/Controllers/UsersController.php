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
use Ignite\Users\Entities\User;
use Ignite\Users\Foundation\PermissionManager;
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
        $this->data['users'] = User::all();
        return view('users::index', ['data' => $this->data]);
    }

    /**
     * @param RoleRepository $roles
     * @param UserRepository $user
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function users(RoleRepository $roles, UserRepository $user, Request $request) {
        if ($request->isMethod('post')) {
            $this->validate($request, Validation::validate_user());
            if (SetupFunctions::add_system_user($request, $user)) {
                flash('User added');
                return redirect()->route('settings.users');
            }
        }
        $this->data['roles'] = $roles->all()->reject(function ($value) {
                    return $value->slug === 'sudo';
                })->pluck('name', 'id');
        $this->data['users'] = SetupFunctions::getSystemUsers();
        return view('settings::users')->with('data', $this->data);
    }

    public function user_groups(Request $request) {
        if ($request->isMethod('post')) {
            dd($request->all());
        }
        $this->data['user_groups'] = UserGroup::all()->reject(function ($value) {
            return $value->name === 'sudo';
        });
        return view('settings::user_groups')->with('data', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create_users() {
        $roles = $this->role->all();

        return view('users::new_user', compact('roles'));
    }

}
