<?php

Route::group(['namespace' => 'NpmWeb\MyAppName\Controllers\Frontend'], function() {
    Route::get('/', 'OrganizationsController@index');
});
