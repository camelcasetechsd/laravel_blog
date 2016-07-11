<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        //seeding user table
        $this->call('UsersTableSeeder');
        $this->call('PostsTableSeeder');
    }

}
