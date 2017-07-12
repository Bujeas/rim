<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        $now = date('Y-m-d H:i:s');

		DB::table('users')->insert([
            'staff_id' => '00000001',
            'email' => 'ron.admin@prasarana.com.my',
            'password' => Hash::make('1q2w3e4r'),
            'activated'  => 1,
            'first_name' => 'Ronanonymous',
            'last_name' => 'SYSTEM',
            'created_at' => $now,
			'updated_at' => $now
        ]);
    }
}
