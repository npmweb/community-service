<?php

use NpmWeb\ServiceOpportunities\Models\Campaign;

class CampaignTableSeeder extends Seeder {

    public function run()
    {
        DB::table('campaigns')->delete();

        foreach( range(2011,2015) as $i => $year ) {
            Campaign::create([
                'id' => $i+1,
                'name' => $year,
                'permalink' => $year,
                'current' => ($year == 2015),
                'default_start_datetime' => $year.'-01-01',
                'default_end_datetime' => $year.'-04-26',
            ]);
        }
    }

}
