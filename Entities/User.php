<?php

namespace Ignite\Users\Entities;

use Ignite\Hr\Entities\Employee;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Ignite\Users\Entities\User
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string|null $permissions
 * @property int $active
 * @property string|null $last_login
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $employee_id
 * @property-read mixed $admin
 * @property-read mixed $ex
 * @property-read mixed $gravator
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Ignite\Users\Entities\UserProfile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Ignite\Users\Entities\UserRoles[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getGravatorAttribute() {
        return gravatar($this->email);
    }

    public function profile() {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function roles() {
        return $this->hasMany(UserRoles::class, 'user_id');
    }

    public function getAdminAttribute() {
        $is_admin = FALSE;

        $roles = array();
        foreach ($this->roles as $role) {
            $roles[] = $role->roles->slug;
        }

        if (in_array("sudo", $roles) || in_array("admin", $roles)) {
            $is_admin = TRUE;
        }

        return $is_admin;
    }

    public function getExAttribute() {
        $is_ex = FALSE;

        $roles = array();
        foreach ($this->roles as $role) {
            $roles[] = $role->roles->slug;
        }

        if (in_array("external-user", $roles)) {
            $is_ex = TRUE;
        }

        return $is_ex;
    }

}
