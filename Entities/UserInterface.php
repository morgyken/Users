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

namespace Ignite\Users\Entities;

interface UserInterface {

    /**
     * Checks if a user belongs to the given Role ID
     * @param  int $roleId
     * @return bool
     */
    public function hasRoleId($roleId);

    /**
     * Checks if a user belongs to the given Role Name
     * @param  string $name
     * @return bool
     */
    public function hasRoleName($name);

    /**
     * Check if the current user is activated
     * @return bool
     */
    public function isActivated();
}
