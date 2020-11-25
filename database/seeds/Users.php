<?php

use App\User;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 1 ; $i++) {
            array_push($data, [
                'name' => 'ADMIN',
                'email' => 'admin@gmail.com',
                'avatar' => 'favicon.png',
                'password' => bcrypt('12345'),
                'role'     => 10,
            ]);
        }

        User::insert($data);
    }
}
