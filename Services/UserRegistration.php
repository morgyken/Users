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

namespace Ignite\Users\Services;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Ignite\Core\Contracts\Authentication;
use Ignite\Users\Events\UserHasRegistered;
use Ignite\Users\Repositories\RoleRepository;

/**
 * Description of UserRegistration
 *
 * @author Samuel Dervis <samueldervis@gmail.com>
 */
class UserRegistration {

    /**
     * @var Authentication
     */
    private $auth;

    /**
     * @var RoleRepository
     */
    private $role;

    /**
     * @var array
     */
    private $input;

    public function __construct(Authentication $auth, RoleRepository $role) {
        $this->auth = $auth;
        $this->role = $role;
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function register(array $input) {
        $this->input = $input;

        $user = $this->createUser();

        if ($this->hasProfileData()) {
            $this->createProfileForUser($user);
        }

        $this->assignUserToUsersGroup($user);

        event(new UserHasRegistered($user));
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        return $user;
    }

    private function createUser() {
        return $this->auth->register((array) $this->input);
    }

    private function assignUserToUsersGroup($user) {
        $role = $this->role->findByName('User');

        $this->auth->assignRole($user, $role);
    }

    /**
     * Check if the request input has a profile key
     * @return bool
     */
    private function hasProfileData() {
        return isset($this->input['profile']);
    }

    /**
     * Create a profile for the given user
     * @param $user
     */
    private function createProfileForUser($user) {
        $profileData = array_merge($this->input['profile'], ['user_id' => $user->id]);
        app('Ignite\Profile\Repositories\ProfileRepository')->create($profileData);
    }

}
