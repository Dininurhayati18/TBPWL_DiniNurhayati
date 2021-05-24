<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    public function run()
    {
        $user = [
            [
                'name' => 'User A',
                'username' => 'user_a',
                'email' => 'user_a@gmail.com',
                'password' => bcrypt('123456'),
                'photo' => 'user.jpg',
                'roles_id' => 2
            ],
            [
                'name' => 'Admin A',
                'username' => 'admin_a',
                'email' => 'admin_a@gmail.com',
                'password' => bcrypt('123456'),
                'photo' => 'admin.jpg',
                'roles_id' => 1
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
