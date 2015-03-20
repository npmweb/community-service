<?php

use NpmWeb\ServiceOpportunities\Models\Participant;

class ParticipantTableSeeder extends Seeder {

    public function run()
    {
        DB::table('participants')->delete();

        $f = Faker\Factory::create();
        foreach( range(1,40) as $i ) {
            foreach( range(1,5) as $j ) {
                Participant::create([
                    'registration_id' => $i,
                    'first_name' => $f->firstName,
                    'last_name' => $f->lastName,
                    'age' => $f->randomElement(['0-12','13+']),
                ]);
            }
        }
    }

}
