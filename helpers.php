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

use Ignite\Users\Entities\Sentinel;
use Ignite\Users\Repositories\RoleRepository;

/**
 * Get users in specified roles
 * @param $roles
 * @return \Illuminate\Database\Eloquent\Collection|static[]
 */
function users_in($roles)
{
    return Sentinel::whereHas('roles', function ($query) use ($roles) {
        if (is_array($roles)) {
            $query->whereIn('id', $roles);
        } else {
            $query->where('id', $roles);
        }
    })->with('profile')->get();
}

/**
 * Get all user roles
 * @return mixed
 */
function all_roles()
{
    return app(RoleRepository::class)->all()->reject(function ($name) {
        return $name->slug == 'sudo';
    })->pluck('name', 'id');
}

function get_external_institutions()
{
    return Ignite\Evaluation\Entities\PartnerInstitution::all()->pluck('name', 'id');
}

function getUserClininics()
{
    try {
        $clinics = json_decode(Auth::user()->profile->clinics);
    } catch (\Exception $e) {
        $clinics = null;
    }
    return $clinics;
}