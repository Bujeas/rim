<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->delete();
        $now = date('Y-m-d H:i:s');

        $user_id = DB::table('users')->select('id')
                                     ->where('email', 'ron.admin@prasarana.com.my')
                                     ->first()
                                     ->id;

		$group_id = DB::table('roles')->select('id')
		                               ->where('name', 'Administrator')
		                               ->first()
		                               ->id;

		DB::table('role_users')->insert([
            'user_id' => $user_id,
	        'role_id' => $group_id,
	        'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
