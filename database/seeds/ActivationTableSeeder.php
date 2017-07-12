<?php

use Illuminate\Database\Seeder;

class ActivationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('activations')->delete();
        $now = date('Y-m-d H:i:s');

        DB::table('activations')->insert([
            'id' => '1',
            'user_id' => '1',
            'code' => '1',
            'completed' => '1',
            'completed_at' => $now,
	        'created_at' => $now,
			'updated_at' => $now
        ]);
    }
}
