<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StationsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // load csv
        // $contents = Storage::get('csv/stations.csv');
        $data_directory = public_path().'/data/csv/stations.csv';
        $stationsCSV = fopen($data_directory, "r");
        $handle = true;

        while (($row = fgetcsv($stationsCSV, 0, ',')) !=FALSE) {

            // Station
            DB::table('stations')->insert([
                'station_no' => $row[1],
                'station_name' => $row[2],
                'floor_id' => 1,
                'equipment_type_id' => 1,
                'equipment_sub_type_id' => 1,
                'cd_noncd_flag' => $row[6],
                'equipment_descriptions' => $row[7],
                'location' => $row[8],
                'activated' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
