<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();
        $now = date('Y-m-d H:i:s');

        DB::table('roles')->insert([
            'slug' => 'Administrator',
            'name' => 'Administrator',
	        'permissions' => '{"admin":1,"user.list":1,"group.delete":1,"group.create.post":1,"group.assign":1,"group.assign.post":1,"group.create":1,"user.create.post":1,"user.delete":1,"user.create":1,"user.update.put":1,"user.update":1}',
	        'created_at' => $now,
			'updated_at' => $now
        ]);

        DB::table('roles')->insert([
            'slug' => 'Moderator',
            'name' => 'Moderator',
            'permissions' => '{"admin":1,"user.list":1}',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('roles')->insert([
            'slug' => 'EndUser',
            'name' => 'EndUser',
            'permissions' => '{"user.list":1}',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
