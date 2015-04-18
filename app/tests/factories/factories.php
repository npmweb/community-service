<?php

use Carbon\Carbon;
use NpmWeb\ServiceOpportunities\Models\Beneficiary;
use NpmWeb\ServiceOpportunities\Models\Campaign;
use NpmWeb\ServiceOpportunities\Models\Opportunity;
use NpmWeb\ServiceOpportunities\Models\OpportunityOccurrence;
use NpmWeb\ServiceOpportunities\Models\Organization;

$factory(Campaign::class, [
    'name' => $faker->word,
    'permalink' => $faker->word,
    'default_end_datetime' => Carbon::now()->addDay(),
    'current' => true,
]);

$factory(Organization::class, [
    'name' => $faker->word,
    'permalink' => $faker->word,
]);

$factory(Beneficiary::class, [
    'organization_id' => 'factory:'.Organization::class,
    'name' => $faker->word,
]);

$factory(Opportunity::class, [
    'beneficiary_id' => 'factory:'.Beneficiary::class,
    'campaign_id' => 'factory:'.Campaign::class,
    'name' => $faker->word,
    'description' => $faker->text,
    'type' => 'regular',
]);

$factory(OpportunityOccurrence::class, [
    'opportunity_id' => 'factory:'.Opportunity::class,
    'signup_deadline' => Carbon::now()->addDay(),
]);
