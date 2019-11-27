<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FieldVisitCategorySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Field Visit Category Name
        DB::table('field_visit_categories')->insert([
            'category_name' => 'Audit Check',
            'category_description' => 'Audit Check',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Field Visit Category Name
        DB::table('field_visit_categories')->insert([
            'category_name' => 'Safety Observation',
            'category_description' => 'Safety Observation',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Field Visit Category Name
        DB::table('field_visit_categories')->insert([
            'category_name' => 'Incident Investigation',
            'category_description' => 'Incident Investigation',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Others
        DB::table('field_visit_categories')->insert([
            'category_name' => 'Others (please specify)',
            'category_description' => 'Others (please specify)',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
