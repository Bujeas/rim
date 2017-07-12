<?php

use Illuminate\Database\Seeder;

class UserGroupTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users_groups')->delete();

        $user_id = DB::table('users')->select('id')
                                     ->where('email', 'ron.admin@prasarana.com.my')
                                     ->first()
                                     ->id;

		$group_id = DB::table('groups')->select('id')
		                               ->where('name', 'Administrator')
		                               ->first()
		                               ->id;

		DB::table('users_groups')->insert([
            'user_id' => $user_id,
	        'group_id' => $group_id
        ]);
    }
}
