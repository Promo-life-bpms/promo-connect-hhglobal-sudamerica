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
