<?php
return array(

    /*
    |--------------------------------------------------------------------------
    | Payment Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default payment "driver" that will be used when
    | using the Payment library. Of course, you may use other drivers any
    | time you wish. This is the default when another is not specified.
    |
    | Supported: "payflow", "braintree",
    |
    */

    'driver' =>  getenv('PAYMENT_PROVIDER'),

    'test' => !is_production(),

    'audit_log_table' => 'tx_audit',

    'provider_config' => [
        'braintree' => [
            'merchant_id' => getenv('BRAINTREE_merchant_id'),
            'public_key' => getenv('BRAINTREE_public_key'),
            'private_key' => getenv('BRAINTREE_private_key'),
            'merchant_account_id' => getenv('BRAINTREE_merchant_account'),
            'descriptor_name_prefix' => 'PFX*', // constant prefix seen on user's stmt
            'descriptor_phone' => '555-555-5555',
            'processor_url' => getenv('BRAINTREE_url'),
            'payment_required_fields' => [
                'payment_method_nonce' => 'paymentMethodNonce',
                'contact_first_name' => 'firstName',
                'contact_last_name' => 'lastName',
                'contact_email' => 'email',
                'pmt_amount' => 'amount',
            ],
            'billing_required_fields' => [ // our field => braintree field
                'pmt_first_name' => 'firstName',
                'pmt_last_name' => 'lastName',
                // 'pmt_address' => 'streetAddress',
                'pmt_postal_code' => 'postalCode',
            ],
            'billing_optional_fields' => [ // our field => braintree field
                // 'pmt_city' => 'locality',
                // 'pmt_state' => 'region',
                // 'pmt_country' => 'countryCodeAlpha2',
            ],
            'shipping_required_fields' => [ // our field => braintree field
                'contact_first_name' => 'firstName',
                'contact_last_name' => 'lastName',
                // 'contact_address' => 'streetAddress',
                // 'contact_postal_code' => 'postalCode',
                // 'contact_city' => 'locality',
                // 'contact_state' => 'region',
                // 'contact_country' => 'countryCodeAlpha2',
            ],
            'shipping_optional_fields' => [ // our field => braintree field
            ],
            // which custom fields does your app want to require?
            'custom_required_fields' => [ // our field => braintree fieldname
                'pmt_item_name' => 'pmt_item_name',
                'campus' => 'campus',
                'pmt_category' => 'pmt_category',
            ],
            'custom_optional_fields' => [ // our field => braintree fieldname
            ],
            'recurring_plans' => [ // our field => braintree field
                // 'monthly_5th' => ['monthly_5th'],
                // 'monthly_20th' => ['monthly_20th'],
                // 'semimonthly' => ['monthly_5th','monthly_20th'],
            ],


        ],
    ]

);
