<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                'username' => 'admin',
                'name' => 'admin',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('admin'),
                'avatar' => '/images/avatars/default.png    '
            ),
            array(
                'username' => 'ahmed',
                'name' => 'ahmed',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('ahmed'),
                'avatar' => '/images/avatars/default.png'
            ),
            array(
                'username' => 'hazeem',
                'name' => 'hazeem',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('hazeem'),
                'avatar' => '/images/avatars/default.png'
            ),
            array(
                'username' => 'maged',
                'name' => 'maged',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('maged'),
                'avatar' => '/images/avatars/default.png'
            ),
        );

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        $this->command->info('User table has been seeded!');
    }

}
