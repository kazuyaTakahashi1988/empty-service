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

    	for ($i=0; $i < 30; $i++) {
	        DB::table('users')->insert([
	            'name' => 'test 【 '.$i.' 】',
	            'email' => 'test'.$i.'@test.com',
	            'password' => bcrypt('testtest'.$i),
	        ]);
	    }
    }
}
