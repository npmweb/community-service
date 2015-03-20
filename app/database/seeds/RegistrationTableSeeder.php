<?php

use NpmWeb\ServiceOpportunities\Models\Registration;

class RegistrationTableSeeder extends Seeder {

    public function run()
    {
        DB::table('registrations')->delete();

        $f = Faker\Factory::create();
        foreach( range(1,4) as $occ ) {
            foreach( range(1,10) as $i ) {
                $record = new Registration;
                $id = 10 * ($occ - 1) + $i;
                $input = [
                    'id' => $id,
                    'occurrence_id' => $occ,
                    'first_name' => $f->firstName,
                    'last_name' => $f->lastName,
                    'age' => $f->randomElement(['0-12','13+']),
                    'address1' => $f->streetAddress,
                    'address2' => $f->secondaryAddress,
                    'city' => $f->city,
                    'state' => $f->state,
                    'postal_code' => $f->postCode,
                    'country' => $f->countryCode,
                    'phone' => $f->phoneNumber,
                    'email' => $f->safeEmail,
                    'num_participants' => $f->numberBetween(1,4),
                    'num_sponsorships' => ($occ >= 3 ? $f->numberBetween(1,4) : null ),
                    'status' => 'confirmed',
                    'created_at' => '2015-01-'.$i,
                    'updated_at' => '2015-01-'.$i,
                ];
                // var_dump($input);
                $record->fill($input);
                $result = $record->save();
                // var_dump($record->errors());
                // var_dump($result);
            }
        }
    }

}
