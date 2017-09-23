<?php

namespace Ignite\Users\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Users\Entities\Roles
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string|null $permissions
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Ignite\Users\Entities\UserRoles[] $assignees
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Roles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Roles whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Roles wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Roles whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\Roles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Roles extends Model {

    protected $fillable = [];
    public $table = 'roles';

    public function assignees() {
        return $this->hasMany(UserRoles::class, 'role_id');
    }

}
