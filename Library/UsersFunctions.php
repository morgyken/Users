<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Users\Library;

use Ignite\Users\Entities\Sentinel;
use Ignite\Users\Entities\User;
use Ignite\Users\Entities\UserProfile;
use Ignite\Users\Repositories\MyUsers;
use Ignite\Users\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Description of UsersFunctions
 *
 * @author samuel
 */
class UsersFunctions implements MyUsers {

    /**
     * Enroll user to system
     * @param Request $request
     * @param UserRepository $user
     * @return bool Successful enrolment
     */
    public function add_system_user(Request $request, UserRepository $user) {
        //for sentinel
        $user_data = [
            'username' => strtolower($request->login),
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'first_name' => ucfirst($request->first_name),
            'middle_name' => ucfirst($request->middlename),
            'last_name' => ucfirst($request->last_name),
            'phone' => '0790551161',
            'job_description' => $request->job,
            'title' => $request->title,
            'mpdb' => $request->mpdb,
            'pin' => $request->pin
        ];
        $role = intval($request->user_group);
        return $user->createUserWithProfile($user_data, $role);
        /* $param = [
          'username' => $request->login,
          'password' => $request->password,
          'to' => $request->email
          ]; //not yet ready
          //sendWelcomeMail($param); */
    }

    /**
     * Edit System User data
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function edit_system_user(Request $request, $id) {
        DB::transaction(function () use ($request, $id) {
            $user = User::find($id);
            $user->username = strtolower($request->login);
            $user->email = $request->email;
            if ($request->has('user_group')) {
                $user->group_id = $request->user_group;
            }
            $user->save();
            $profile = UserProfile::findOrNew($user->id);
            $profile->user_id = $user->id;
            $profile->first_name = ucfirst($request->first_name);
            $profile->last_name = ucfirst($request->last_name);
            $profile->middle_name = ucfirst($request->middlename);
            $profile->job_description = $request->job;
            $profile->title = $request->title;
            $profile->mpdb = $request->mpdb;
            $profile->phone = $request->mobile;
            $profile->pin = $request->pin;
            $profile->save();
        });

        flash("User information has been saved");
        return true;
    }

    public function getSystemUsers() {
        $roles = ['roles' => function ($query) {
                $query->select(['slug', 'name']);
            }
                ];
                return Sentinel::with($roles)->get()->reject(function ($value) {
                            foreach ($value->roles as $role) {
                                if ($role->slug == 'sudo') {
                                    return true;
                                }
                            }
                            return false;
                        });
            }

        }
