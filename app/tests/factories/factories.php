<?php

use Carbon\Carbon;
use NpmWeb\ServiceOpportunities\Models\Beneficiary;
use NpmWeb\ServiceOpportunities\Models\Campaign;
use NpmWeb\ServiceOpportunities\Models\Opportunity;
use NpmWeb\ServiceOpportunities\Models\OpportunityOccurrence;
use NpmWeb\ServiceOpportunities\Models\Organization;

$factory(Campaign::class, [
    'name' => '2015',
    'permalink' => '2015',
    'default_end_datetime' => Carbon::now()->addDay(),
    'current' => true,
]);

$factory(Organization::class, [
    'name' => 'Test Church',
    'permalink' => 'testchurch',
]);

$factory(Beneficiary::class, [
    'organization_id' => 'factory:'.Organization::class,
    'name' => 'Test Beneficiary',
]);

$factory(Opportunity::class, [
    'beneficiary_id' => 'factory:'.Beneficiary::class,
    'campaign_id' => 'factory:'.Campaign::class,
    'name' => 'Test Opportunity',
    'description' => 'its awesome',
    'type' => 'regular',
]);

$factory(OpportunityOccurrence::class, [
    'opportunity_id' => 'factory:'.Opportunity::class,
    'signup_deadline' => Carbon::now()->addDay(),
]);
