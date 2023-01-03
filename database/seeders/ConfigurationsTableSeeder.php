<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('configurations')->truncate();

        \DB::table('configurations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'label' => 'background',
                'value' => '14.png',
            ),
            1 =>
            array (
                'id' => 2,
                'label' => 'logo',
                'value' => 'logo-1.png',
            ),

        ));


    }
}
