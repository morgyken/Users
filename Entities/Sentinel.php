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
use Ignite\Users\Repositories\UserInterface;
use Illuminate\Support\Facades\Config;

/**
 * Ignite\Users\Entities\Sentinel
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property array $permissions
 * @property int $active
 * @property string|null $last_login
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Activations\EloquentActivation[] $activations
 * @property-read mixed $gravatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Persistences\EloquentPersistence[] $persistences
 * @property-read \Ignite\Users\Entities\UserProfile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Reminders\EloquentReminder[] $reminders
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Roles\EloquentRole[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Throttling\EloquentThrottle[] $throttle
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Sentinel whereUsername($value)
 * @mixin \Eloquent
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

    /*
      public function profile() {
      return $this->hasOne(UserProfile::class, 'user_id');
      }
     */

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

    public function profile() {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

}
