<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'smart_joseph',
                'email' => 'smartjoseh@gmail.com',
                'password' => Hash::make('smart@joseh'), // Change this password after first login
            ],
            [
                'name' => 'Joseph Kirika',
                'email' => 'josephkirika@example.com',
                'password' => Hash::make('password456'), // Change this password after first login
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'), // Change this password after first login
            ],
        ];

        foreach ($admins as $admin) {
            DB::table('users')->updateOrInsert(
                ['email' => $admin['email']],
                array_merge($admin, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
