<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class adminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->truncate();
        \DB::table('admins')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'photo' => 'blank.png',
                'email_verified_at' => '2020-12-02 15:46:31',
                'password' => '$2y$10$WvrDFmaoR3FQu72W04Fcheg9OzjRN8jTqh5gS91in43q/CHGT15LG',
                'remember_token' => 'je8KIknlZFFmrPPli2xwBzzBlq3omENInTJ4xGelQd0aHug6XEkAbDi7xOPU',
                'super' => 1,
                'status' => 1,
                'created_at' => '2020-12-02 15:47:25',
                'updated_at' => '2021-11-08 11:19:58'
            ]
        ]);
    }
}
