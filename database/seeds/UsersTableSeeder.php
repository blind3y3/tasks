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
        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@tasks.loc',
            'password' => bcrypt('iddqd'),
            'isManager' => true
        ]);
    }
}
