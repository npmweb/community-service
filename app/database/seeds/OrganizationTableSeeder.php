<?php

use NpmWeb\ServiceOpportunities\Models\Organization;

class OrganizationTableSeeder extends Seeder {

    public function run()
    {
        DB::table('organizations')->delete();

        $o = Organization::create([
            'id' => 1,
            'permalink' => 'abc',
            'name' => 'Parent Church',
            'address1' => '4350 North Point Parkway',
            'city' => 'Alpharetta',
            'state' => 'GA',
            'postal_code' => '30022',
            'country' => 'US',
            'from_email' => 'from@tables.org',
        ]);
        $o->campaigns()->sync([1,2,3,4,5]);

        $o = Organization::create([
            'id' => 2,
            'permalink' => 'bcd',
            'parent_organization_id' => 1,
            'name' => 'Child Church',
            'address1' => '4350 North Point Parkway',
            'city' => 'Alpharetta',
            'state' => 'GA',
            'postal_code' => '30022',
            'country' => 'US',
            'from_email' => 'from@tables.org',
        ]);
        $o->campaigns()->sync([3,4,5]);

        $o = Organization::create([
            'id' => 3,
            'permalink' => 'cde',
            'parent_organization_id' => 1,
            'name' => 'Third Church',
            'address1' => '4350 North Point Parkway',
            'city' => 'Alpharetta',
            'state' => 'GA',
            'postal_code' => '30022',
            'country' => 'US',
            'from_email' => 'from@tables.org',
        ]);
        $o->campaigns()->sync([1,2,3]);

        $o = Organization::create([
            'id' => 4,
            'permalink' => 'def',
            'name' => 'Unrelated Church',
            'address1' => '4350 North Point Parkway',
            'city' => 'Alpharetta',
            'state' => 'GA',
            'postal_code' => '30022',
            'country' => 'US',
            'from_email' => 'from@tables.org',
        ]);
        $o->campaigns()->sync([1,2,3]);

    }

}
