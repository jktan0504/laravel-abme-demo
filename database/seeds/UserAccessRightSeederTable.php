<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserAccessRightSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_access_rights')->insert([
            'user_access_right_name' => 'Administrator Modules',
            'user_access_right_id' => 'administrator',
            'user_access_right_description' => 'Full Feature and Edit Function',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_access_rights')->insert([
            'user_access_right_name' => 'Engineer Report and Checklist',
            'user_access_right_id' => 'engineer_report_checklist',
            'user_access_right_description' => 'All engineer report and checklist related modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_access_rights')->insert([
            'user_access_right_name' => 'Preventive Maintenance Report & Checklist',
            'user_access_right_id' => 'preventive_maintenance_report_checklist',
            'user_access_right_description' => 'All preventive maintenance report & checklist related modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_access_rights')->insert([
            'user_access_right_name' => 'FRS',
            'user_access_right_id' => 'frs',
            'user_access_right_description' => 'All frs related modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_access_rights')->insert([
            'user_access_right_name' => 'CMS',
            'user_access_right_id' => 'cms',
            'user_access_right_description' => 'All cms related modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_group_has_access_rights')->insert([
            'user_group_id' => 1,
            'user_access_rights' => '1,2,3,4,5',
            'remarks' => 'Admin has full feature and edit function',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_group_has_access_rights')->insert([
            'user_group_id' => 2,
            'user_access_rights' => '2,3,4,5',
            'remarks' => 'Engineer Access Right Modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_group_has_access_rights')->insert([
            'user_group_id' => 3,
            'user_access_rights' => '3,4',
            'remarks' => 'Station Master Access Right Modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_group_has_access_rights')->insert([
            'user_group_id' => 4,
            'user_access_rights' => '3,4',
            'remarks' => 'Sbst Group Access Right Modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_group_has_access_rights')->insert([
            'user_group_id' => 5,
            'user_access_rights' => '3',
            'remarks' => 'Preventive Maintenance Team Access Right Modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_group_has_access_rights')->insert([
            'user_group_id' => 6,
            'user_access_rights' => '4,5',
            'remarks' => 'Duty & Corrective Maintenance Team Access Right Modules',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
