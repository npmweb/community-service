<?php

namespace NpmWeb\MyAppName\Models;

class Organization extends \NpmWeb\LaravelBase\Models\BaseUidModel {

    public static $rules = [
        'name' => [ 'required', 'max:150' ],
        'logo' => [ 'max:45' ],
        'url' => [ 'max:150', 'url' ],
        'address' => [ 'max:150' ],
        'city' => [ 'max:45' ],
        'state' => [ 'max:45' ],
        'postal_code' => [ 'max:45' ],
        'country' => [ 'max:45' ],
        'permalink' => [ 'required', 'max:45', 'permalink', ],
        'email' => [ 'required', 'max:150', 'email' ],
    ];

    public $fillable = [
        'name', 'logo', 'url', 'address', 'city', 'state',
        'postal_code', 'country', 'permalink', 'email',
    ];

    public function __toString() {
        return $this->name;
    }

    public function scopeWithWebSite($query) {
        return $query->whereNotNull('url');
    }

}