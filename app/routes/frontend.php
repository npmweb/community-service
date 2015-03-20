<?php

Route::group(['namespace' => 'NpmWeb\Intersect\Controllers\Frontend'], function() {
    Route::get('monitor', 'MonitorController@index');
});

Route::group(['namespace' => 'NpmWeb\ServiceOpportunities\Controllers\Frontend'], function() {
    // regular reg
    Route::get('/', [
        'as' => 'organization.index',
        'uses' => 'OrganizationsController@index',
    ]);
    Route::get('search/{organization}', [
        'as' => 'organization.index',
        'uses' => 'OrganizationsController@index',
    ]);
    Route::get('opportunity-occurrences/{organization}', [
        'as' => 'opportunity-occurrence.index',
        'uses' => 'OpportunityOccurrencesController@index',
    ]);

    // normal reg
    Route::get('signup/{opportunity}', [
        'as' => 'registration.create',
        'uses' => 'RegistrationsController@create',
    ]);
    Route::post('signup', [
        'as' => 'registration.store',
        'uses' => 'RegistrationsController@store',
    ]);
    Route::get('success', [
        'as'=>'success',
        'uses' => 'RegistrationsController@success',
    ]);

    // cyo reg
    Route::post('cyo', [
        'as' => 'cyo.store',
        'uses' => 'CyoProjectController@store',
    ]);
    Route::get('cyo/confirmation', [
        'as' => 'cyo.confirm',
        'uses' => 'CyoProjectController@confirm',
    ]);
    Route::get('cyo/{church?}', [
        'as' => 'cyo.create',
        'uses' => 'CyoProjectController@create',
    ]);
});
