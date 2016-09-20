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

use Ignite\Users\Foundation\PermissionManager;
use Ignite\Users\Http\Requests\RolesRequest;
use Ignite\Users\Repositories\RoleRepository;

class RolesController extends UserBaseController {

    /**
     * @var RoleRepository
     */
    private $role;

    public function __construct(PermissionManager $permissions, RoleRepository $role) {
        parent::__construct();
        $this->permissions = $permissions;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $this->data['roles'] = $this->role->all();
        return view('users::roles.index', ['data' => $this->data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('users::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RolesRequest $request
     * @return Response
     */
    public function store(RolesRequest $request) {
        $data = $this->mergeRequestWithPermissions($request);
        $this->role->create($data);
        flash('Role created');
        return redirect()->route('users.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        if (!$role = $this->role->find($id)) {
            flash()->error('Role not found');
            return redirect()->route('admin.user.role.index');
        }
        return view('users::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  RolesRequest $request
     * @return Response
     */
    public function update($id, RolesRequest $request) {
        $data = $this->mergeRequestWithPermissions($request);
        $this->role->update($id, $data);
        flash('Role updated');
        return redirect()->route('users.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        $this->role->delete($id);
        flash('Role deleted');
        return redirect()->route('users.role.index');
    }

}
