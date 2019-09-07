<?php

use App\User;
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
        // create a admin user
        factory(User::class)->create([
            'name' => 'Gaurav Jain',
            'email' => 'gaurav@vkaps.com',
            'is_admin' => 1,
        ]);
        
        // create 10 random test users
        factory(User::class, 10)->create();
    }
}
