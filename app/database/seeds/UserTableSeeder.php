<?php

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete(); // deleting old records.

        User::create(
            array(
                'email' => 'reachme@amitavroy.com',
                'password' => Hash::make('password'),
                'user_type' => 'normal',
            )
        );
    }
}