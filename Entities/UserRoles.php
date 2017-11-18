<?php

namespace Ignite\Users\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Users\Entities\UserRoles
 *
 * @property int $user_id
 * @property int $role_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Ignite\Users\Entities\Roles $Roles
 * @property-read \Ignite\Users\Entities\User $Users
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserRoles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserRoles whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserRoles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserRoles whereUserId($value)
 * @mixin \Eloquent
 */
class UserRoles extends Model {

    protected $fillable = [];
    public $table = 'role_users';
    protected $with = ['Roles'];

    public function Users() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function Roles() {
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }

}
