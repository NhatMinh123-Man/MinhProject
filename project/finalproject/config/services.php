<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '565319657933900',  //client face của bạn
        'client_secret' => '37ed4a6dcf932e1a2f20c705bacaa0a2',  //client app service face của bạn
        'redirect' => 'http://localhost/project/admin/callback' //callback trả về
    ],

    'google' => [
        'client_id' => '639267918713-fp4fjrfm4g8ha3mek0ek2hqme7ne5pqp.apps.googleusercontent.com',
        'client_secret' => 'Pqiiwg4DovQLFYqPdp0mdxrX',
        'redirect' => 'http://localhost/project/google/callback' 
    ],


];
