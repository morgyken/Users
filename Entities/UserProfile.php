<?php

namespace Ignite\Users\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Users\Entities\UserProfile
 *
 * @property int $user_id
 * @property int $title
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $job_description
 * @property string|null $phone
 * @property mixed|null $photo
 * @property string|null $mpdb
 * @property string|null $pin
 * @property string|null $clinics
 * @property int|null $partner_institution
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $full_name
 * @property-read mixed $name
 * @property-read \Ignite\Evaluation\Entities\PartnerInstitution|null $partnerInstitution
 * @property-read \Ignite\Users\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereClinics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereJobDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereMpdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile wherePartnerInstitution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Users\Entities\UserProfile whereUserId($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model {

    protected $guarded = [];
    public $incrementing = false;
    public $primaryKey = 'user_id';
    public $table = 'users_user_profiles';

    public function getFullNameAttribute() {
        $name = mconfig('users.users.titles.' . $this->title) . ' '
                . $this->first_name . " " . $this->middle_name_name . ' ' . $this->last_name;
        return ucwords($name);
    }

    public function getNameAttribute() {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function partnerInstitution() {
        return $this->belongsTo(\Ignite\Evaluation\Entities\PartnerInstitution::class, 'partner_institution', 'id');
    }

}
