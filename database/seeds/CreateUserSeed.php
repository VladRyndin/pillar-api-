<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = Str::random(10).'@gmail.com';
        $token = Str::random(60);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => $email,
            'password' => Hash::make('password'),
            'api_token' => $token
        ]);

        dump(["email" => $email, "token" => $token, "pass" => "password"]);
    }
}
