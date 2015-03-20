<?php

use NpmWeb\ServiceOpportunities\Models\CyoProjectRegistration;

class CyoProjectRegistrationTableSeeder extends Seeder {

    public function run()
    {
        DB::table('cyo_project_registrations')->delete();

        $f = Faker\Factory::create();
        foreach( range(1,10) as $i ) {
            $endDate = $f->iso8601;
            $startDate = $f->iso8601($endDate);

            $record = new CyoProjectRegistration;
            $input = [
                'organization_id' => 1,
                'campaign_id' => 4,
                'first_name' => $f->firstName,
                'last_name' => $f->lastName,
                'address1' => $f->streetAddress,
                'address2' => $f->secondaryAddress,
                'city' => $f->city,
                'state' => $f->state,
                'postal_code' => $f->postCode,
                'country' => 'US',
                'phone' => $f->phoneNumber,
                'email' => $f->safeEmail,
                'description' => $f->sentence,
                'num_hours' => $f->randomFloat(2,1,4),
                'num_participants' => $f->numberBetween(1,10),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'created_at' => '2015-01-'.$i,
                'updated_at' => '2015-01-'.$i,
            ];
            // var_dump($input);
            $record->fill($input);
            $result = $record->save();
            // var_dump($result);
        }
    }

}
