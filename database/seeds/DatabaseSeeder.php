<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        if (App::environment() === 'production')
            exit();

        Eloquent::unguard();

        // Truncate all tables, except migrations
        $dbName = DB::Connection()->getDatabaseName();
        DB::drop();
        DB::create($dbName);
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table)
        {
            if ($table->{'Tables_in_' . $dbName} !== 'migrations')
                DB::table($table->{'Tables_in_' . $dbName})->delete();
        }

        // Find and run all seeders
        $classes = require base_path() . '/vendor/composer/autoload_classmap.php';
        foreach ($classes as $class)
        {
            if (strpos($class, 'TableSeeder') !== false)
            {
                $seederClass = substr(last(explode('/', $class)), 0, -4);
                $this->call($seederClass);
            }
        }
    }

}
