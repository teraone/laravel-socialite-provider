<?php

return [



    /*
   |--------------------------------------------------------------------------
   | Webhook Route
   |--------------------------------------------------------------------------
   |
   | This is the route to where your webhooks will be sent
   | You can disable the publishing of the route to handle the requests
   | by yourself.
   | You can also define which middleware should be called.
   |
   */

    'routes' => [
        'publish' => env('HELLO_ONE_SOCIALITE_PUBLISH_ROUTES', true),
        'middleware' => ['web'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Project Details
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    'project_url' => env('HELLO_ONE_SOCIALITE_PROJECT_URL', 'https://demo.hello-one.de'),


    'client_id' => env('HELLO_ONE_SOCIALITE_CLIENT_ID'),
    'client_secret' => env('HELLO_ONE_SOCIALITE_CLIENT_SECRET'),

    // the full login url as string
    'login_url' =>  'https://www.webhook-test.test/hello-one/login',

    // the path og the login url path
    'login_path' => 'hello-one/login',

];
