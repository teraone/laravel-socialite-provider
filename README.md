# [Laravel Socialite](https://laravel.com/docs/7.x/socialite) Provider for [hello one](https://www.hello-one.de)


    WORK IN PROGRESS - DO NOT USE IN PRODUCTION - WORK IN PROGRESS

Use your [hello one](https://www.hello-one.de) guest list as a login provider for your Laravel App.
 

## Installation
 1) You can install this package via composer using the following command:
    ```shell script
    composer require hello-one/laravel-socialite-provider
    ```
    The package will automatically register itself using [package discovery](https://laravel.com/docs/packages#package-discovery).

   
 2) Add your app as a OAuth Client on our [dashboard](https://dashboard.hello-one.de/). 
 
    As `Redirect Callback URL` we suggest 
    `https://{{yourLaravelApplication.com}}/hello-one/callback`
    
    Add the Client ID and Client Secret to your  `.env` file
    ```dotenv
    HELLO_ONE_SOCIALITE_CLIENT_ID={{ CLIENT_ID }}
    HELLO_ONE_SOCIALITE_CLIENT_SECRET={{ CLIENT_SECRET }}
    HELLO_ONE_SOCIALITE_CLIENT_REDIRECT={{ https://yourLaravelApplication.com/hello-one/callback }}
    HELLO_ONE_SOCIALITE_PROJECT_URL={{ https://your-hello-one-default-domain.com }}
    ```
    Or publish the configuration

    ```shell script
    php artisan vendor:publish --tags 'hello-one-socialite'
    ```
    and edit  `config/hello-one-socialite.php` accordingly.
    
 3) Create your routes in `web.php`
    ```php
    Route::get( 'hello-one/login', [ \App\Http\Controllers\Controller::class, 'redirectToProvider' ]);
    Route::get( 'hello-one/callback', [ \App\Http\Controllers\Controller::class, 'handleProviderCallback' ]);   
    ```
 4) Create your controller methods 
        
    ```php
    /**
     * Redirect the user to the hello one login/authorization page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(\Illuminate\Http\Request $request)
    {
       return Socialite::driver('hello-one-guest')
           ->stateless()
           ->scopes(['account:read'])
           ->redirect();
    
    }
     
    /**
     * Obtain the user information from hello one.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('hello-one-guest')
            ->stateless()
            ->scopes(['account:read'])
            ->user();
        
        echo 'Hi' . $user->email;
    }
    ```
  5) Visit `https://{{yourLaravelApplication.com}}/hello-one/login` and you will be redirected to hello one to login/authorize.


## Documentation
Please notice our [OAuth Documentation](https://docs.hello-one.de/project-settings/oauth.html)

## Contributing
Feel free to open a ticket, submit a Pull Request or ask our [Support Team](mailto:info@hello-one.de)

