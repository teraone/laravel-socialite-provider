<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Client ID and secret
    |--------------------------------------------------------------------------
    |
    | Please find the values in your hello one dashboard.
    |
    */

    'client_id' => env('HELLO_ONE_SOCIALITE_CLIENT_ID'),
    'client_secret' => env('HELLO_ONE_SOCIALITE_CLIENT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Callback / Redirect URL
    |--------------------------------------------------------------------------
    |
    | This must be exactly the same as in you hello one dashboard
    |
    */

    'redirect' => env('HELLO_ONE_SOCIALITE_REDIRECT', 'https://your-laravel-app.example.com/hello-one/callback'),


    /*
    |--------------------------------------------------------------------------
    | Project Details
    |--------------------------------------------------------------------------
    | Please provide the full URL of your hello one project.
    | You should use your primary domain
    |
    | Example: https://my-demo-project.com
    |
    */

    'project_url' => env('HELLO_ONE_SOCIALITE_PROJECT_URL', 'https://PLEASE_USE_YOUR_DOMAIN.hello-one.app'),



];
