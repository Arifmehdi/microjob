<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->updateOrCreate([
            'name'              => 'admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('111'),
            'remember_token'    => Str::random(10),
            'is_admin'          => true,
            'status'            => true,
            'is_deletable'      => false,
        ]);
    }
}
