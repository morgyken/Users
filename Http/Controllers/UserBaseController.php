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

use Ignite\Core\Http\Controllers\AdminBaseController;

abstract class UserBaseController extends AdminBaseController {

    /**
     * @var PermissionManager
     */
    protected $permissions;

    /**
     * @param $request
     * @return array
     */
    protected function mergeRequestWithPermissions($request) {
        $permissions = [];
        if (!$this->permissions->permissionsAreAllFalse($request->permissions)) {
            $permissions = $this->permissions->clean($request->permissions);
        }
        return array_merge($request->all(), [ 'permissions' => $permissions]);
    }

}
