<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'full_name' => 'Administrator',
            'company_name' => 'Test Company Pte Ltd',
            'email' => 'admin@mail.com',
            'contact' => '60167488864',
            'salt_value' => 'ac1fgs',
            'password' => bcrypt('12345678'),
            'team_id' => 1,
            'user_group_id' => 1,
            'remarks' => 'Administrator',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'admin2',
            'full_name' => 'Administrator 2',
            'company_name' => 'Test Company Pte Ltd',
            'email' => 'admin2@mail.com',
            'contact' => '60127938715',
            'salt_value' => 'ac1fgs',
            'password' => bcrypt('12345678'),
            'team_id' => 1,
            'user_group_id' => 1,
            'remarks' => 'Administrator',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'engineer1',
            'full_name' => 'Engineer 1',
            'company_name' => 'Test Company Pte Ltd',
            'email' => 'engineer1@mail.com',
            'contact' => '60127938716',
            'salt_value' => 'ac1fgs',
            'password' => bcrypt('12345678'),
            'team_id' => 2,
            'user_group_id' => 2,
            'remarks' => 'Engineer',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'stationmaster1',
            'full_name' => 'Station Master 1',
            'company_name' => 'Test Company Pte Ltd',
            'email' => 'stationmaster1@mail.com',
            'contact' => '60127938717',
            'salt_value' => 'ac1fgs',
            'password' => bcrypt('12345678'),
            'team_id' => 3,
            'user_group_id' => 3,
            'remarks' => 'Station Master',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'sbst1',
            'full_name' => 'Sbst 1',
            'company_name' => 'Test Company Pte Ltd',
            'email' => 'sbst1@mail.com',
            'contact' => '60127938718',
            'salt_value' => 'ac1fgs',
            'password' => bcrypt('12345678'),
            'team_id' => 4,
            'user_group_id' => 4,
            'remarks' => 'Sbst',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'preventive1',
            'full_name' => 'Preventive 1',
            'company_name' => 'Test Company Pte Ltd',
            'email' => 'preventive1@mail.com',
            'contact' => '60127938719',
            'salt_value' => 'ac1fgs',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Preventive',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'dcm1',
            'full_name' => 'Duty & Corrective Maintenance 1',
            'company_name' => 'Test Company Pte Ltd',
            'email' => 'dcm1@mail.com',
            'contact' => '60127938710',
            'salt_value' => 'ac1fgs',
            'password' => bcrypt('12345678'),
            'team_id' => 6,
            'user_group_id' => 6,
            'remarks' => 'Duty & Corrective Maintenance',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // ===== Real =====
        
        // Adminstrator
        DB::table('users')->insert([
            'username' => 'hblai',
            'full_name' => 'ACM Lai',
            'company_name' => 'ACM Lai',
            'email' => 'hanwei9689@gmail.com',
            'contact' => '6592321558',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 1,
            'user_group_id' => 1,
            'remarks' => 'ACM Lai',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'Melvin.ang',
            'full_name' => 'Melvin Ang',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'melvin.ang@abme.com.sg',
            'contact' => '6597890906',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 1,
            'user_group_id' => 1,
            'remarks' => 'Ang Brothers (M&E)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'fern',
            'full_name' => 'Kasak Supaporn',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'fern@abme.com.sg',
            'contact' => '6583998839',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 1,
            'user_group_id' => 1,
            'remarks' => 'Ang Brothers (M&E) Adminstrator',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'sk.ang',
            'full_name' => 'SK Ang',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'sk.ang@abme.com.sg',
            'contact' => '6594559427',
            'salt_value' => 'abme-adminstrator',
            'password' => bcrypt('12345678'),
            'team_id' => 1,
            'user_group_id' => 1,
            'remarks' => 'Ang Brothers (M&E) Adminstrator',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Engineer
        DB::table('users')->insert([
            'username' => 'kelvin.say',
            'full_name' => 'Kelvin Say (Engineer)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'kelvin.say@abme.com.sg',
            'contact' => '6591541549',
            'salt_value' => 'abme-engineer',
            'password' => bcrypt('12345678'),
            'team_id' => 2,
            'user_group_id' => 2,
            'remarks' => 'Ang Brothers (M&E) Engineer',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'azad',
            'full_name' => 'Azad (Engineer)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'azad@abme.com.sg',
            'contact' => '6598568247',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 2,
            'user_group_id' => 2,
            'remarks' => 'Azad (Engineer)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'kelvin.liu',
            'full_name' => 'Kelvin Liu (Engineer)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'kelvin.liu@abme.com.sg',
            'contact' => '6598344122',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 2,
            'user_group_id' => 2,
            'remarks' => 'Kelvin Liu (Engineer)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'alvin.ng',
            'full_name' => 'Alvin Ng Heng San (Engineer)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'alvin.ng@abme.com.sg',
            'contact' => '6597279792',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 2,
            'user_group_id' => 2,
            'remarks' => 'Alvin Ng (Engineer)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'lawrence.ong',
            'full_name' => 'Ong Chee Boon (Engineer)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'lawrence.ong@abme.com.sg',
            'contact' => '6597317979',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 2,
            'user_group_id' => 2,
            'remarks' => 'Ong Chee Boon (Engineer)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        // Preventive Maintenance 
        DB::table('users')->insert([
            'username' => 'alpha',
            'full_name' => 'Alpha Team (PM)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'alpha@abme.com.sg',
            'contact' => '6596279790',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Alpha Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'bravo',
            'full_name' => 'Brave Team (PM)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'bravo@abme.com.sg',
            'contact' => '6596425784',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Brave Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'charlie',
            'full_name' => 'Charlie Team (PM)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'charlie@abme.com.sg',
            'contact' => '6596480460',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Charlie Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'delta',
            'full_name' => 'Delta Team (PM)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'delta@abme.com.sg',
            'contact' => '6582189312',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Delta Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'echo',
            'full_name' => 'Echo Team (PM)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'echo@abme.com.sg',
            'contact' => '6597714967',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Echo Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'sierra',
            'full_name' => 'Sierra Team (PM)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'sierra@abme.com.sg',
            'contact' => '6592348227',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Sierra Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'falcon',
            'full_name' => 'Falcon Team (PM)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'falcon@abme.com.sg',
            'contact' => '6588768270',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Falcon Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'hawk',
            'full_name' => 'Hawk Team (PM)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'hawk@abme.com.sg',
            'contact' => '6597286607',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 5,
            'user_group_id' => 5,
            'remarks' => 'Hawk Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        // Duty & Corrective Maintenance
        DB::table('users')->insert([
            'username' => 'tango',
            'full_name' => 'Tango Team (Duty)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'Tango@abme.com.sg',
            'contact' => '6597505462',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 6,
            'user_group_id' => 6,
            'remarks' => 'Tango Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'viper',
            'full_name' => 'Viper Team (Duty)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'viper@abme.com.sg',
            'contact' => '6596548883',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 6,
            'user_group_id' => 6,
            'remarks' => 'Viper Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'leo',
            'full_name' => 'Leo Team (Duty)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'leo@abme.com.sg',
            'contact' => '6596581844',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 6,
            'user_group_id' => 6,
            'remarks' => 'Leo Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'username' => 'jaguar',
            'full_name' => 'Jaguar Team (Duty)',
            'company_name' => 'Ang Brothers (M&E) Pte Ltd',
            'email' => 'jaguar@abme.com.sg',
            'contact' => '6597276685',
            'salt_value' => 'abme',
            'password' => bcrypt('12345678'),
            'team_id' => 6,
            'user_group_id' => 6,
            'remarks' => 'Jaguar Team (PM)',
            'account_status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
