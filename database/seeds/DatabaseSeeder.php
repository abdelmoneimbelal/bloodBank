<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		//Model::unguard();
        $this->call(LaratrustSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserstableSeeder::class);
    }
}
