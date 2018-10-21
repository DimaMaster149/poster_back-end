<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // $this->call(UsersTableSeeder::class);
	    factory(App\Event::class, 10)->create();
    }
}
