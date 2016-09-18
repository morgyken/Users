<?php

namespace Ignite\Users\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Users\Entities\Roles
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $permissions
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Roles whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Roles whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Roles whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Roles wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Roles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Roles extends Model {

    protected $fillable = [];
    public $table = 'roles';

}
