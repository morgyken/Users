<?php

namespace Ignite\Users\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Ignite\Users\Entities\User
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $permissions
 * @property boolean $active
 * @property string $last_login
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $gravator
 * @property-read \Ignite\Users\Entities\UserProfile $profile
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\User whereUpdatedAt($value)
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

}
