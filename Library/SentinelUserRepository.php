<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: iClinic
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Users\Library;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Ignite\Users\Entities\UserProfile;
use Ignite\Users\Events\UserHasRegistered;
use Ignite\Users\Events\UserWasUpdated;
use Ignite\Users\Exceptions\UserNotFoundException;
use Ignite\Users\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Description of SentinelUserRepository
 *
 * @author Samuel Dervis <samueldervis@gmail.com>
 */
class SentinelUserRepository implements UserRepository {

    protected $user;

    /**
     * @var \Cartalyst\Sentinel\Roles\EloquentRole
     */
    protected $role;

    public function __construct() {
        $this->user = Sentinel::getUserRepository()->createModel();
        $this->role = Sentinel::getRoleRepository()->createModel();
    }

    /**
     * Returns all the users
     * @return object
     */
    public function all() {
        return $this->user->all();
    }

    /**
     * Create a user resource
     * @param $data
     * @return mixed
     */
    public function create(array $data) {
        $user = $this->user->create((array) $data);

        event(new UserHasRegistered($user));

        return $user;
    }

    /**
     * Create a user and assign roles to it
     * @param  array $data
     * @param  array $roles
     * @param bool $activated
     */
    public function createWithRoles($data, $roles, $activated = false) {
        $this->hashPassword($data);
        $user = $this->create((array) $data);
        if (!empty($roles)) {
            $user->roles()->attach($roles);
        }
        if ($activated) {
            $activation = Activation::create($user);
            Activation::complete($user, $activation->code);
        }
    }

    public function createUserWithProfile($data, $roler) {
        if (!is_int($roler)) {
            $role = Sentinel::findRoleBySlug($roler);
        } else {
            $role = Sentinel::findRoleById($roler);
        }
        $filter = ['username', 'email', 'password'];
        $user = $this->user->create(array_only($data, $filter));
        if (!empty($role))
            $role->users()->attach($user);
        $pro = array_except($data, $filter);
        $pro['user_id'] = $user->id;
        UserProfile::create($pro);
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        return true;
    }

    /**
     * Create a user and assign roles to it
     * But don't fire the user created event
     * @param array $data
     * @param array $roles
     * @param bool $activated
     */
    public function createWithRolesFromCli($data, $roles, $activated = false) {
        $this->hashPassword($data);
        $user = $this->user->create((array) $data);

        if (!empty($roles)) {
            $user->roles()->attach($roles);
        }

        if ($activated) {
            $activation = Activation::create($user);
            Activation::complete($user, $activation->code);
        }
    }

    /**
     * Find a user by its ID
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->user->find($id);
    }

    /**
     * Update a user
     * @param $user
     * @param $data
     * @return mixed
     */
    public function update($user, $data) {
        $user = $user->update($data);
        event(new UserWasUpdated($user));

        return $user;
    }

    /**
     * @param $userId
     * @param $data
     * @param $roles
     * @internal param $user
     * @return mixed
     */
    public function updateAndSyncRoles($userId, $data, $roles) {
        $user = $this->user->find($userId);

        $this->checkForNewPassword($data);

        $this->checkForManualActivation($user, $data);

        $user = $user->fill($data);
        $user->save();
        $this->update_profile($userId, $data);

        event(new UserWasUpdated($user));

        if (!empty($roles)) {
            $user->roles()->sync($roles);
        }
    }

    public function update_profile($user, $data) {
        $profile = UserProfile::findOrNew($user);
        try {
            $profile->user_id = $user;
            $profile->first_name = ucfirst($data['first_name']);
            $profile->last_name = ucfirst($data['last_name']);
            $profile->partner_institution = $data['partner_institution'];
            $profile->job_description = $data['job_description'];
            $profile->title = $data['title'];
            $profile->mpdb = $data['mpdp'];
            $profile->phone = $data['phone'];
            $profile->pin = $data['pin'];
            $profile->save();
        } catch (\Exception $e) {

        }
    }

    public function delete($id) {
        if ($user = $this->user->find($id)) {
            return $user->delete();
        };

        throw new UserNotFoundException();
    }

    /**
     * Find a user by its credentials
     * @param  array $credentials
     * @return mixed
     */
    public function findByCredentials(array $credentials) {
        return Sentinel::findByCredentials($credentials);
    }

    /**
     * Hash the password key
     * @param array $data
     */
    private function hashPassword(array &$data) {
        $data['password'] = Hash::make($data['password']);
    }

    /**
     * Check if there is a new password given
     * If not, unset the password field
     * @param array $data
     */
    private function checkForNewPassword(array &$data) {
        if (!$data['password']) {
            unset($data['password']);
            return;
        }
        $data['password'] = Hash::make($data['password']);
    }

    /**
     * Check and manually activate or remove activation for the user
     * @param $user
     * @param array $data
     */
    private function checkForManualActivation($user, array &$data) {
        if (Activation::completed($user) && !$data['activated']) {
            return Activation::remove($user);
        }

        if (!Activation::completed($user) && $data['activated']) {
            $activation = Activation::create($user);

            return Activation::complete($user, $activation->code);
        }
    }

    /*
    * Get the system users by a given role
    */ 
    public function getUsersByRole($slug)
    {
        $users = $this->all()->load(['roles', 'profile']);

        return $users->filter(function($user) use($slug){
            
            return $user->roles->pluck('slug')->search($slug)  != false;

        });
    }  

}
