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
use Ignite\Users\Entities\User;
use Ignite\Users\Foundation\PermissionManager;
use Ignite\Users\Http\Requests\CreateUserRequest;
use Ignite\Users\Http\Requests\UpdateUserRequest;
use Ignite\Users\Repositories\MyUsers;
use Ignite\Users\Repositories\RoleRepository;
use Ignite\Users\Repositories\UserRepository;
use Illuminate\Http\Request;

class UsersController extends UserBaseController {

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

    /**
     * @var MyUsers
     */
    private $my_users;

    /**
     * @param PermissionManager $permissions
     * @param UserRepository $user
     * @param RoleRepository $role
     * @param Authentication $auth
     * @param MyUsers $my
     */
    public function __construct(PermissionManager $permissions, UserRepository $user, RoleRepository $role, Authentication $auth, MyUsers $my) {
        parent::__construct();
        $this->permissions = $permissions;
        $this->user = $user;
        $this->role = $role;
        $this->auth = $auth;
        $this->my_users = $my;
    }

    public function index() {
        $this->data['users'] = User::all();
        return view('users::index', ['data' => $this->data]);
    }

    public function edit($id) {
        if (!$user = $this->user->find($id)) {
            flash()->error('User not found');
            return redirect()->route('users.index');
        }
        $roles = $this->role->all();
        $currentUser = $this->auth->check();
        return view('users::edit', compact('user', 'roles', 'currentUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int               $id
     * @param  UpdateUserRequest $request
     * @return Response
     */
    public function update($id, UpdateUserRequest $request) {
        $data = $this->mergeRequestWithPermissions($request);
        $this->user->updateAndSyncRoles($id, $data, $request->roles);
        flash('User updated');
        return redirect()->route('users.index');
    }

    /**
     * @param RoleRepository $roles
     * @param UserRepository $user
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function users(RoleRepository $roles, UserRepository $user, Request $request) {
        if ($request->isMethod('post')) {
            if ($this->my_users->add_system_user($request, $user)) {
                flash('User added');
                return redirect()->route('settings.users');
            }
        }
        $this->data['roles'] = $roles->all()->reject(function ($value) {
                    return $value->slug === 'sudo';
                })->pluck('name', 'id');
        $this->data['users'] = $this->my_users->getSystemUsers();
        return view('settings::users', ['data' => $this->data]);
    }

    public function user_groups(Request $request) {
        if ($request->isMethod('post')) {
            dd($request->all());
        }
        $this->data['user_groups'] = UserGroup::all()->reject(function ($value) {
            return $value->name === 'sudo';
        });
        return view('settings::user_groups', ['data' => $this->data]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest $request
     * @return Response
     */
    public function store(CreateUserRequest $request) {
        $data = $this->mergeRequestWithPermissions($request);
        $this->user->createWithRoles($data, $request->roles, true);
        flash('User created');
        return redirect()->route('users.index');
    }

}
