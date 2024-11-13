<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=> 'admin',
                'email'=> 'admin@gmail.com',
                'role'=> 'admin',
                'password'=> bcrypt('123456')
            ],
            [
                'name'=> 'petugas',
                'email'=> 'petugas@gmail.com',
                'role'=> 'petugas',
                'password'=> bcrypt('123456')
            ],
            [
                'name'=> 'pimpinan',
                'email'=> 'pimpinan@gmail.com',
                'role'=> 'pimpinan',
                'password'=> bcrypt('123456')
            ],
            [
                'name'=> 'konsumen',
                'email'=> 'konsumen@gmail.com',
                'role'=> 'konsumen',
                'password'=> bcrypt('123456')
            ],
        ];
        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
