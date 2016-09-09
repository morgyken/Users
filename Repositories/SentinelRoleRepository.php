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

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

/**
 * Description of SentinelRoleRepository
 *
 * @author Samuel Dervis <samueldervis@gmail.com>
 */
class SentinelRoleRepository implements RoleRepository {

    /**
     * @var \Cartalyst\Sentinel\Roles\EloquentRole
     */
    protected $role;

    public function __construct() {
        $this->role = Sentinel::getRoleRepository()->createModel();
    }

    /**
     * Return all the roles
     * @return mixed
     */
    public function all() {
        return $this->role->all();
    }

    /**
     * Create a role resource
     * @return mixed
     */
    public function create($data) {
        $this->role->create($data);
    }

    /**
     * Find a role by its id
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->role->find($id);
    }

    /**
     * Update a role
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data) {
        $role = $this->role->find($id);

        $role->fill($data);

        $role->save();

        event(new RoleWasUpdated($role));
    }

    /**
     * Delete a role
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $role = $this->role->find($id);

        return $role->delete();
    }

    /**
     * Find a role by its name
     * @param  string $name
     * @return mixed
     */
    public function findByName($name) {
        return Sentinel::findRoleByName($name);
    }

}
