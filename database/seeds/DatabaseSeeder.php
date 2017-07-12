<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        
		$this->call(UserTableSeeder::class);
        $this->command->info('User table seeded!');

        $this->call(GroupTableSeeder::class);
        $this->command->info('Group table seeded!');

        $this->call(RoleTableSeeder::class);
        $this->command->info('Role table seeded!');

        $this->call(RoleUserTableSeeder::class);
        $this->command->info('RoleUser table seeded!');

        $this->call(ActivationTableSeeder::class);
        $this->command->info('Activation table seeded!');

        $this->call(UserGroupTableSeeder::class);
        $this->command->info('User_Group table seeded!');
    }
}
