<?php

use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('123456')
        ]);
        $user->attachRole('super_admin');
    }
}
