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

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Support\Facades\Config;

/**
 * Description of Sentinel
 *
 * @author samuel
 */
class Sentinel extends EloquentUser implements UserInterface {

    /**
     * @var string The primary key
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];
    protected $loginNames = ['username'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Checks if a user belongs to the given Role ID
     * @param  int $roleId
     * @return bool
     */
    public function hasRoleId($roleId) {
        return $this->roles()->whereId($roleId)->count() >= 1;
    }

    /**
     * Checks if a user belongs to the given Role Name
     * @param  string $name
     * @return bool
     */
    public function hasRoleName($name) {
        return $this->roles()->whereName($name)->count() >= 1;
    }

    /**
     * Check if the current user is activated
     * @return bool
     */
    public function isActivated() {
        return (bool) Activation::completed($this);
    }

    public function profile() {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function getGravatarAttribute() {
        return gravatar($this->email, 160);
    }

    public function __call($method, $parameters) {
        $class_name = class_basename($this);
        #i: Convert array to dot notation
        $config = implode('.', ['relations', $class_name, $method]);
        #i: Relation method resolver
        if (Config::has($config)) {
            $function = Config::get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

}
