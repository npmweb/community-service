<?php

use NpmWeb\ServiceOpportunities\Models\OpportunityOccurrence;

class OpportunityOccurrenceTableSeeder extends Seeder {

    public function run()
    {
        DB::table('opportunity_occurrences')->delete();

        OpportunityOccurrence::create([
            'id' => 1,
            'opportunity_id' => 1,
            'occurrence_date' => '2020-01-08',
            'start_time' => '10:00 AM',
            'end_time' => '1:30 PM',
            'signup_deadline' => '2020-01-01 5:00 PM',
            'capacity' => 20,
            'min_participants_per_registration' => 2,
        ]);

        OpportunityOccurrence::create([
            'id' => 2,
            'opportunity_id' => 1,
            'occurrence_date' => '2020-01-15',
            'start_time' => '10:00 AM',
            'end_time' => '1:30 PM',
            'signup_deadline' => '2020-01-01 5:00 PM',
            'capacity' => 20,
            'min_participants_per_registration' => 2,
        ]);

        OpportunityOccurrence::create([
            'id' => 3,
            'opportunity_id' => 2,
            'sponsorship_end_date' => '2020-02-01',
            'num_sponsorships' => 17,
            'signup_deadline' => '2020-01-01 5:00 PM',
        ]);

        OpportunityOccurrence::create([
            'id' => 4,
            'opportunity_id' => 2,
            'sponsorship_end_date' => '2020-03-01',
            'num_sponsorships' => 17,
            'signup_deadline' => '2020-02-01 5:00 PM',
        ]);

    }

}
