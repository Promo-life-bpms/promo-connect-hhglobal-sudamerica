<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LocationSeeder extends Seeder
{
    public function run()
    {

        DB::table('location')->insert([
            [
                'name' => 'Guatemala',
                'description' => null, 
                'currency' => 'GTQ',
                'value' => 7.80, 
            ],
            [
                'name' => 'Costa Rica',
                'description' => null,
                'currency' => 'CRC',
                'value' => 550.00,
            ],
            [
                'name' => 'Argentina',
                'description' => null,
                'currency' => 'ARS',
                'value' => 350.00,
            ],
            [
                'name' => 'Chile',
                'description' => null,
                'currency' => 'CLP',
                'value' => 850.00,
            ],
            [
                'name' => 'Peru',
                'description' => null,
                'currency' => 'PEN',
                'value' => 3.70,
            ],
            [
                'name' => 'Brazil',
                'description' => null,
                'currency' => 'BRL',
                'value' => 4.80,
            ],
            [
                'name' => 'Colombia',
                'description' => null,
                'currency' => 'COP',
                'value' => 4200.00,
            ],
            [
                'name' => 'Uruguay',
                'description' => null,
                'currency' => 'UYU',
                'value' => 40.00,
            ],
            [
                'name' => 'Paraguay',
                'description' => null,
                'currency' => 'PYG',
                'value' => 7100.00,
            ],
            [
                'name' => 'Ecuador',
                'description' => null,
                'currency' => 'USD',
                'value' => 1.00,
            ],
            [
                'name' => 'Bolivia',
                'description' => null,
                'currency' => 'BOB',
                'value' => 6.90,
            ],
        ]);


        DB::table('user_has_location')->insert([
            [
                'user_id' => 1,
                'location_id' => 1, 
            ],
            [
                'user_id' => 2,
                'location_id' => 1, 
            ],
            [
                'user_id' => 3,
                'location_id' => 1, 
            ],
            [
                'user_id' => 4,
                'location_id' => 1, 
            ],
        ]);

    }
}
