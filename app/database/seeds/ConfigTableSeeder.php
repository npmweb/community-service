<?php

use NpmWeb\ServiceOpportunities\Models\Config;

class ConfigTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->delete();

        Config::create([
            'system_name' => 'Community Service',
            'allow_cyo_project_registrations' => true,
            'show_filter_organization' => true,
            'show_filter_beneficiary' => true,
            'show_filter_time_of_week' => true,
            'show_filter_time_of_day' => true,
            'show_agreement_page' => false,
            'allow_multiple_participants' => true,
            'collect_address' => true,
            'collect_country' => true,
            'required_payment_amount' => 0,
            'allow_optional_payments' => false,
            'content_search' => 'search',
            'content_agreement' => '',
            'content_registration_form' => '',
        ]);
    }

}
