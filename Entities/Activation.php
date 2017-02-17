<?php

namespace Ignite\Users\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Users\Entities\Activation
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property bool $completed
 * @property string $completed_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Activation whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Activation whereCompleted($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Activation whereCompletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Activation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Activation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Activation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Users\Entities\Activation whereUserId($value)
 * @mixin \Eloquent
 */
class Activation extends Model {

    protected $fillable = [];
    public $table = 'activations';

}
