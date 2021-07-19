<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@rms.com',
            'password' => bcrypt("123456"),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@rms.com',
            'password' => bcrypt("123456"),
            'role_id' => 2,
        ]);
        factory(App\User::class, 10)->create();
    }
}
