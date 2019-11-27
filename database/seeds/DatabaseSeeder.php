<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserTeamSeederTable::class);
        $this->call(UserAccessRightSeederTable::class);
        $this->call(UserSeederTable::class);
        $this->call(StationsEquipmentTypeSeederTable::class);
        $this->call(StationsEquipmentSubTypeSeederTable::class);
        $this->call(StationsSubDetailsSeederTable::class);
        $this->call(StationsFloorSeederTable::class);
        $this->call(StationsSeederTable::class);
        $this->call(FieldVisitCategorySeederTable::class);
        $this->call(MailGroupCategorySeederTable::class);
    }
}
