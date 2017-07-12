<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('groups')->delete();
        $now = date('Y-m-d H:i:s');

        DB::table('groups')->insert([
            'name' => 'Administrator',
	        'permissions' => '{"admin":1,"user.list":1,"group.delete":1,"group.create.post":1,"group.assign":1,"group.assign.post":1,"group.create":1,"user.create.post":1,"user.delete":1,"user.create":1,"user.update.put":1,"user.update":1,"onboard":1,"onboard.list":1,"onboard.create":1,"onboard.create.post":1,"onboard.update":1,"onboard.update.put":1,"onboard.delete":1}',
	        'created_at' => $now,
			'updated_at' => $now
        ]);

        DB::table('groups')->insert([
            'name' => 'Moderator',
            'permissions' => '{"admin":1,"user.list":1}',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('groups')->insert([
            'name' => 'EndUser',
            'permissions' => '{"user.list":1}',
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }
}
