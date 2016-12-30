<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id'     => '1003036189787326',
        'client_secret' => '8a1a050849faf8e87c30a15c4150c8ae',
        'redirect'      => 'http://homestead.app/login/handle/facebook',
    ],
    'google' => [
        'client_id'     => '382009689082-5g5m8rjt0250qchr9uk7m3rq57e6bmi8.apps.googleusercontent.com',
        'client_secret' => 'D_16yWTd1QUJjYDjyLaDOLgK',
        'redirect'      => 'http://homestead.app/login/handle/google',
    ],

];
