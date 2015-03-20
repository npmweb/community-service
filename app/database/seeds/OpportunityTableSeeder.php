<?php

use NpmWeb\ServiceOpportunities\Models\Opportunity;

class OpportunityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('opportunities')->delete();

        $o = new Opportunity;
        $o->fill([
            'id' => 1,
            'beneficiary_id' => 1,
            'campaign_id' => 4,
            'type' => 'regular',
            'name' => 'Build Tables',
            'description' => 'Build some tables to help people!',
            'warning_text' => 'This is no picnic!',
            'children_rules' => 'No kids allowed.',
            'notes' => 'This is a new thing we are trying.',
            'contact_phone' => '555-555-5555',
            'contact_email' => 'person@tables.org',
            'contact_person' => 'Tables Person',
            'location_name' => 'Awesome Place',
            'location_address1' => '123 Awesome Street',
            'location_city' => 'Awesome',
            'location_state' => 'TN',
            'location_postal_code' => '55555',
            'location_country' => 'US',
            'location_driving_instructions' => 'Drive far',
            'location_parking_instructions' => 'Park near',
            'location_special_instructions' => 'Be careful',
            'collect_participant_info' => true,
        ]);
        $o->save();
        $o->attributeValues()->sync([17, 22, 24, 27]);

        $o = new Opportunity;
        $o->fill([
            'id' => 2,
            'beneficiary_id' => 1,
            'campaign_id' => 4,
            'type' => 'sponsorship',
            'name' => 'Sponsor a Family',
            'sponsorship_label' => 'family',
            'description' => 'Build some tables to help people!',
            'warning_text' => 'This is no picnic!',
            'children_rules' => 'No kids allowed.',
            'notes' => 'This is a new thing we are trying.',
            'contact_phone' => '555-555-5555',
            'contact_email' => 'person@tables.org',
            'contact_person' => 'Tables Person',
            'location_name' => 'Awesome Place',
            'location_address1' => '123 Awesome Street',
            'location_city' => 'Awesome',
            'location_state' => 'TN',
            'location_postal_code' => '55555',
            'location_country' => 'US',
            'location_driving_instructions' => 'Drive far',
            'location_parking_instructions' => 'Park near',
            'location_special_instructions' => 'Be careful',
        ]);
        $o->save();
        $o->attributeValues()->sync([17, 22, 24, 27]);
    }

}
