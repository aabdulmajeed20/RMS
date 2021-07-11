<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin'],
            ['name' => 'User']
        ]);
        DB::table('tags')->insert([
            ['name' => 'Technology'],
            ['name' => 'Sport'],
            ['name' => 'Medical']
        ]);
        DB::table('groups')->insert([
            ['name' => 'Saudi Arabia'],
            ['name' => 'U.S.'],
            ['name' => 'General']
        ]);
        DB::table('abilities')->insert([
            ['name' => 'create_report'],
            ['name' => 'view_report'],
            ['name' => 'delete_report'],
            ['name' => 'update_report'],
            ['name' => 'create_group'],
            ['name' => 'delete_group'],
            ['name' => 'update_group'],
            ['name' => 'assign_to_group'],
            ['name' => 'revoke_from_group']
        ]);
        
    }
}
