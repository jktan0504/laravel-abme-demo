<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StationsEquipmentSubTypeSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Equipment Sub Type
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => '(CD) Cooling Tower (CLT)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => '(CD) Cooling Water Pump',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Air Compressor (SAC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 3,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Air Dryer (DRY)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 3,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Air Handling Unit (AHU)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Air Receiver (AIR)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 3,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Automatic Tube Cleaning System (ATC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Blast Valve',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 2,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'British Thermal Unit (BTU)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // 10
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Bypass Valve (BPV)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Chiller Water Pump',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Common Area CRAC',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => '(CD) Cooling Tower (CLT)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => '(CD) Cooling Water Pump',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => '(CTP-HIGH-ALM) Condensate Water Level Sensor',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 11,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Air Compressor (SAC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 3,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Air Dryer (DRY)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 3,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Air Handling Unit (AHU)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Air Receiver (AIR)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 3,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // 20
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Automatic Tube Cleaning System (ATC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Blast Valve',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 2,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'British Thermal Unit (BTU)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Bypass Valve (BPV)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Chiller Water Pump',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'CO2 Sensor (CO2)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 11,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Common Area CRAC',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Condensate Transfer / Recovery Tank',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Condensate Transfer Pump',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Condensate Water Valve (CWV)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // 30
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Cooling Tower (CLT)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Differential Pressure Sensor (DPS)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 11,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Distribution Board (DB)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Electro-Pneumatic Panel (EPP)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Emergency Power Unit (EPU)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Exhaust Air Fan (EXF)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 8,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Exhaust Air Fan (EXF-)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 8,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Fan Coil Unit (FCU)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Feed & Expansion Pressure Vessel',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Feed & Expansion Pump',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // 40
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Feed & Expansion Tank',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Feed & Expansion Tank Ball Float Valve (FET)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Flow Meter (FM)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Gas Filter',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Gas Shut Off Valve',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Humidity Sensor (HS)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 11,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Intake Air Fan (INF)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 8,
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'KWT Panel',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'LM Panel',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Local Control Panel (LCP)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // 50
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Local Sequential Controller (LSC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Make-up Water Tank',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Make-up Water Tank (MWT)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Motor Control Centre (MCC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Motorized Control Valve (MCV)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Motorized Damper (MD)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 4,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Non-Chemical Treatment Plant (NCP)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Overpressure Blast Valve',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Overpressure Valve',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Packaged Evaporator Unit  (PEU) / Packaged Condensation Unit  (PCU)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // 60
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Pneumatic Damper (PD)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 4,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Pot Feeder Chemical Treatment',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Pressure Relief Damper (PRD)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 4,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Pressure Sensor (PS)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 11,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Refrigerant Leak Detector',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Smoke Control Panel (SCP)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Smoke Curtain (SC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 8,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Smoke Extraction Fan (SEF)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 8,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Staircase Pressurization Fan (SPF)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 8,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Sub-Board (SB)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // 70
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Supply Air Fan (SAF)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 8,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Temperature / Thermostat Control Valve',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Temperature Sensor (TS)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 11,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Thermostat (RC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 10,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Tunnel Booster Fan (TBF)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 6,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Tunnel Ventilation Fan (TVF)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 6,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Underplatform Exhaust and Smoke Extraction Fan (UPESEF)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 6,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'UVC Emitter',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Variable Speed Drive',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Variable Speed Drive (VSD)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 13,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // 80
        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Ventilation Control Panel (VCP)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Water Cooled Chiller (WCC)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Water Flow Switch',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 1,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('equipment_sub_types')->insert([
            'equipment_sub_type_name' => 'Zone Control Panel (ZCP)',
            'equipment_sub_type_description' => '',
            'equipment_type_id' => 7,
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

    }
}
