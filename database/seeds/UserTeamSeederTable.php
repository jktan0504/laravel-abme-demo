<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTeamSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groups')->insert([
            'user_group_name' => 'Administrator Group',
            'user_group_description' => 'System Administrator with Full Access',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_groups')->insert([
            'user_group_name' => 'Engineer Group',
            'user_group_description' => 'Engineer with Report Module Access',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_groups')->insert([
            'user_group_name' => 'Station Master Group',
            'user_group_description' => 'Station Master with Station Module Access',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_groups')->insert([
            'user_group_name' => 'SBST Group',
            'user_group_description' => 'SBST Group with SBST Group Module Access',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_groups')->insert([
            'user_group_name' => 'Preventive Maintenance Group',
            'user_group_description' => 'SBST Group with SBST Group Module Access',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_groups')->insert([
            'user_group_name' => 'Duty & Corrective Maintenance Group',
            'user_group_description' => 'Duty & Corrective Maintenance Group with Duty & Corrective Maintenance Group Module Access',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teams')->insert([
            'team_name' => 'Administrator Team',
            'team_description' => 'System Administrator Team',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teams')->insert([
            'team_name' => 'Engineer Team',
            'team_description' => 'Engineer Team',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teams')->insert([
            'team_name' => 'Station Master Team',
            'team_description' => 'Station Master Team',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teams')->insert([
            'team_name' => 'SBST Team',
            'team_description' => 'SBST Team',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teams')->insert([
            'team_name' => 'Preventive Maintenance Team',
            'team_description' => 'Preventive Maintenance Team',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('teams')->insert([
            'team_name' => 'Duty & Corrective Maintenance Team',
            'team_description' => 'Duty & Corrective Maintenance Team',
            'activated' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
