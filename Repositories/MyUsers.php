<?php

namespace Ignite\Users\Repositories;

use Illuminate\Http\Request;

interface MyUsers {

    /**
     * Enroll user to system
     * @param Request $request
     * @param UserRepository $user
     * @return bool Successful enrolment
     */
    public function add_system_user(Request $request, UserRepository $user);

    /**
     * Edit System User data
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function edit_system_user(Request $request, $id);

    /**
     * @return mixed
     */
    public function getSystemUsers();
}
