<?php

namespace Ignite\Users\Database\Seeders;

use Ignite\Users\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    protected $user;

    public function __construct(UserRepository $user) {
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user_data = [
            'username' => 'newadmin',
            'password' => bcrypt('admin'),
            'email' => 'info@collabmed.com',
            'first_name' => 'Collabmed',
            'middle_name' => 'Solutions',
            'last_name' => 'Inc.',
            'phone' => '0710123145',
            'job_description' => 'Support and maintanance',
        ];
        $this->user->createUserWithProfile($user_data, 1);
        $sudo_data = [
            'username' => 'dervis',
            'password' => bcrypt('dervis'),
            'email' => 'sodhiambo@collabmed.com',
            'first_name' => 'Samuel',
            'middle_name' => 'Odhiambo',
            'last_name' => 'Okoth',
            'phone' => '0790551161',
            'job_description' => 'Systems developer',
        ];
        $this->user->createUserWithProfile($sudo_data, 2);
    }

}
