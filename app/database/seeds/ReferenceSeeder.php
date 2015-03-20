<?php

/**
 * Seeds only the reference tables that will actually be seeded in production.
 */
class ReferenceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::statement('SET foreign_key_checks = 0');
        DB::statement('SET UNIQUE_CHECKS=0');

        // app-wide
        $this->call('CampaignTableSeeder');
        $this->call('CallToActionTableSeeder');
        $this->call('UserTypeTableSeeder');
        $this->call('UserTableSeeder'); // for admin user

        DB::statement('SET foreign_key_checks = 1');
        DB::statement('SET UNIQUE_CHECKS=1');         
    }

}
