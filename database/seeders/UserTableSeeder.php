<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        \DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'client',
                'last_name' => 'client',
                'email' => 'client@gmail.com',
                'phone' => '55851451',
                'photo' => 'blank.png',
                'email_verified_at' => '2020-12-02 15:46:31',
                'password' => '$2y$10$WvrDFmaoR3FQu72W04Fcheg9OzjRN8jTqh5gS91in43q/CHGT15LG',
                'remember_token' => 'je8KIknlZFFmrPPli2xwBzzBlq3omENInTJ4xGelQd0aHug6XEkAbDi7xOPU',
                'status' => 1,
                'created_at' => '2020-12-02 15:47:25',
                'updated_at' => '2021-11-08 11:19:58'
            ]
        ]);
    }
}
