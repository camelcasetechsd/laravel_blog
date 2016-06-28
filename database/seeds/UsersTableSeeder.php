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
                'password' => bcrypt('admin')
            ),
            array(
                'username' => 'ahmed',
                'name' => 'ahmed',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('ahmed')
            ),
            array(
                'username' => 'hazeem',
                'name' => 'hazeem',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('hazeem')
            ),
            array(
                'username' => 'maged',
                'name' => 'maged',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('maged')
            ),
        );

        foreach ($users as $user)
        {
            DB::table('users')->insert($user);
        }
    }

}
