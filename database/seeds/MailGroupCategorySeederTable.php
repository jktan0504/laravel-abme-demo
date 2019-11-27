<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MailGroupCategorySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mail Group
        DB::table('mail_groups')->insert([
            'mail_group_name' => 'Fault Call Mail Group',
            'mail_group_description' => 'Fault Call Mail Group',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Mail Group
        DB::table('mail_groups')->insert([
            'mail_group_name' => 'Field Visit Mail Group',
            'mail_group_description' => 'Field Visit Mail Group',
            'activated' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // Mail Group
        // DB::table('mail_lists')->insert([
        //     'mail_group_id' => 1,
        //     'mail_email' => 'jkworkplace1@gmail.com',
        //     'owner_name' => 'JKTAN',
        //     'remarks' => 'Mail Owner',
        //     'activated' => 1,
        //     'created_by' => 1,
        //     'updated_by' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        // DB::table('mail_lists')->insert([
        //     'mail_group_id' => 2,
        //     'mail_email' => 'jktan0504@hotmail.com',
        //     'owner_name' => 'JKTAN',
        //     'remarks' => 'Mail Owner',
        //     'activated' => 1,
        //     'created_by' => 1,
        //     'updated_by' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

    }
}
