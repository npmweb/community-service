<?php

Route::group(['namespace' => 'NpmWeb\LaravelLogin'], function() {
    Route::get('login', 'LoginsController@create');
    Route::resource('logins', 'LoginsController', ['only'=>['create','store','destroy']]);
});

Route::group(['namespace' => 'NpmWeb\ServiceOpportunities\Controllers\Backend', 'before' => 'auth'], function() {
    Route::get('/', function() {
        if( Auth::user()->access(NpmWeb\MultilevelOrganizations\Models\UserType::SITE_ADMIN_LEVEL) ) {
            return Redirect::route('organizations.index');
        } else {
            return Redirect::route('organizations.show',$user->organization->uid);
        }
    });

    Route::resource('attributes', 'AttributesController');
    Route::resource('beneficiaries', 'BeneficiariesController');
    Route::resource('campaign-beneficiaries', 'CampaignBeneficiariesController',
        ['only'=>['create','store']]);
    Route::resource('campaign-organizations', 'CampaignOrganizationsController',
        ['only'=>['create','store']]);
    Route::resource('cyo-project-registrations', 'CyoProjectRegistrationsController');

    Route::get('opportunities/import', ['as'=>'opportunities.import',
        'uses' => 'OpportunitiesController@importForm']); // must be above resource
    Route::post('opportunities/import/preview', ['as'=>'opportunities.import-preview',
        'uses' => 'OpportunitiesController@importPreview']); // must be above resource
    Route::post('opportunities/import', ['as'=>'opportunities.import',
        'uses' => 'OpportunitiesController@importSave']); // must be above resource
    Route::resource('opportunities', 'OpportunitiesController');
    Route::resource('opportunity-occurrences', 'OpportunityOccurrencesController');
    Route::resource('organizations', 'OrganizationsController');
    Route::resource('participants', 'ParticipantsController');
    Route::resource('registrations', 'RegistrationsController',
        ['except'=>['destroy']]);

    Route::get('reports/registrations/full', ['as'=> 'reports.registrations.full',
        'uses' => 'ReportsController@getRegistrationsFull']);
    Route::post('reports/registrations/full', ['as'=> 'reports.registrations.full',
        'uses' => 'ReportsController@postRegistrationsFull']);

    Route::get('reports/registrations/weekly', ['as'=> 'reports.registrations.weekly',
        'uses' => 'ReportsController@getRegistrationsWeekly']);
    Route::post('reports/registrations/weekly', ['as'=> 'reports.registrations.weekly',
        'uses' => 'ReportsController@postRegistrationsWeekly']);

    Route::get('reports/registrations/sponsorships', ['as'=> 'reports.registrations.sponsorships',
        'uses' => 'ReportsController@getRegistrationsSponsorships']);
    Route::post('reports/registrations/sponsorships', ['as'=> 'reports.registrations.sponsorships',
        'uses' => 'ReportsController@postRegistrationsSponsorships']);
});
