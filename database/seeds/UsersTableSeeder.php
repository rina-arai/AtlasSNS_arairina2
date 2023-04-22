<?php

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
        DB::table('users')->insert([
            'username' => '初期ユーザー',
            'mail' => 'user1@gmail.com',
            'password' => bcrypt('user1'),
            'bio' => 'これは初期ユーザーです。初めまして。',
        ]);
    }
}
