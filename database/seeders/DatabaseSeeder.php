<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!User::find(1)) {
            $user = new User;
            $user->name = 'admin';
            $user->email = 'admin@admin.com';
            $user->password = Hash::make('123456');
            $user->role = 'admin';
            $user->save();
        }
    }
}
