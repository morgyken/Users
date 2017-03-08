<?php

namespace Ignite\Users\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Users\Entities\UserRoles
 *
 * @property int $user_id
 * @property int $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\UserRoles whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\UserRoles whereRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\UserRoles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\UserRoles whereUserId($value)
 * @mixin \Eloquent
 */
class UserRoles extends Model {

    protected $fillable = [];
    public $table = 'role_users';

    public function Users() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}
