<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // make user seeder
        $admin = User::create([
            'division_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ]);
        // set role admin
        $admin->assignRole('admin');
    
        $users = [
            [
                'division_id' => 1,
                'name' => 'User2',
                'email' => 'user2@gmail.com',
                'password' => 'password',
            ],
            [
                'division_id' => 2,
                'name' => 'User',
                'email' => 'user@gmail.com',    
                'password' => 'password',
            ],
        ];

        foreach ($users as $user) {
            $user= User::create($user);
            // set role user
            $user->assignRole('user');
        }

    }
}

