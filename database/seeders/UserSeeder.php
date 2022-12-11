<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
        $user_exists = \DB::table('users')->where('name', 'root')->exists();
        if(!($user_exists)) {
            $user = User::create([
                'name' =>'root',
                'email' => 'root@root',
                'password' => Hash::make('rootroot'),
                'profile_photo_path' => 'profile_photo_path',
                'address' => 'address',
                'self_introduction' => 'self introduction',
                'role' => '1',
            ]);
        } else {
            echo 'root of user is exists';
        }
    }
}
