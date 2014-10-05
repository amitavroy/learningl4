<?php 

class SeedUsers extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'display_name' => 'Amitav Roy',
            'email' => 'reachme@amitavroy.com',
            'password' => Hash::make('password'),
            'status' => 1
        ));
    }

}