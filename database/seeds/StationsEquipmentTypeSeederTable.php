<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StationsEquipmentTypeSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Equipment Type
        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Air-Conditioning System (ACS)',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Civil Defence Equipment (CD)',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Compressed Air System (CAS)',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Dampers',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'DTL3 - Sensors',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'DTL3 - Tunnel Ventilation System (TVS)',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Electrical System (ELE)',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Mechanical Ventilation System (MVS)',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Others',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Remote Control',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Sensors',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Tunnel Ventilation System (TVS)',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_types')->insert([
            'equipment_type_name' => 'Variable Speed Drive',
            'equipment_type_description' => '',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
