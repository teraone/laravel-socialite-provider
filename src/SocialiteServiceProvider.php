<?php


namespace HelloOne\Laravel\Socialite;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SocialiteServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom( __DIR__ . '/../config/hello-one-socialite.php', 'hello-one-socialite' );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->bootSocialite();

        if ( $this->app->runningInConsole() ) {
            $this->publishes( [
                __DIR__ . '/../config/hello-one-socialite.php' => config_path( 'hello-one-socialite.php' ),
            ], 'hello-one-socialite' );

        }
    }

    private function bootSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'hello-one-guest',
            function ($app) use ($socialite) {
                $config = [
                    'client_id' => $app['config']['hello-one-socialite.client_id'],
                    'client_secret' => $app['config']['hello-one-socialite.client_secret'],
                    'redirect' =>  $app['config']['hello-one-socialite.redirect'],
                    'scopes' => [
                        'account:read'
                    ]
                ];
                return $socialite->buildProvider(HelloOneGuestProvider::class, $config);
            }
        );
    }

}
