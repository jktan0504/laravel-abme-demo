<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StationsSubDetailsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Brands
        DB::table('brands')->insert([
            'brand_name' => 'Brand A',
            'brand_description' => 'Brand A Description',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('brands')->insert([
            'brand_name' => 'Brand B',
            'brand_description' => 'Brand B  Description',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('brands')->insert([
            'brand_name' => 'Brand C',
            'brand_description' => 'Brand C Description',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Grease Type

        DB::table('grease_types')->insert([
            'grease_type_name' => 'Grease Type I',
            'grease_type_description' => 'Grease Type I',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('grease_types')->insert([
            'grease_type_name' => 'Grease Type II',
            'grease_type_description' => 'Grease Type II',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('grease_types')->insert([
            'grease_type_name' => 'Grease Type III',
            'grease_type_description' => 'Grease Type III',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Location
        DB::table('locations')->insert([
            'location_name' => 'Location AA',
            'location_description' => 'Location AA Description',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('locations')->insert([
            'location_name' => 'Location BB',
            'location_description' => 'Location BB Description',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('locations')->insert([
            'location_name' => 'Location CC',
            'location_description' => 'Location CC Description',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Motor Brands
        DB::table('motor_brands')->insert([
            'motor_brand_name' => 'Motor Brand A1',
            'motor_brand_description' => 'Motor Brand A1',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('motor_brands')->insert([
            'motor_brand_name' => 'Motor Brand B1',
            'motor_brand_description' => 'Motor Brand B1',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('motor_brands')->insert([
            'motor_brand_name' => 'Motor Brand C1',
            'motor_brand_description' => 'Motor Brand C1',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Panel Types
        DB::table('panel_types')->insert([
            'panel_type_name' => 'Panel Type 09I',
            'panel_type_description' => 'Panel Type 09I',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('panel_types')->insert([
            'panel_type_name' => 'Panel Type 08U',
            'panel_type_description' => 'Panel Type 08U',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('panel_types')->insert([
            'panel_type_name' => 'Panel Type 3Y7',
            'panel_type_description' => 'Panel Type 3Y7',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
