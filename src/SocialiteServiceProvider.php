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

        $this->app->make( LoginController::class );

        $this->registerRoutes();


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->bootSpotifySocialite();

        if ( $this->app->runningInConsole() ) {
            $this->publishes( [
                __DIR__ . '/../config/hello-one-socialite.php' => config_path( 'hello-one-socialite.php' ),
            ], 'hello-one-socialite' );

        }
    }

    protected function registerRoutes() {
        if ( config( 'hello-one-socialite.routes.publish', true ) ) {
            Route::group( $this->routeConfiguration(), function () {
                $this->loadRoutesFrom( __DIR__ . '../../routes/web.php' );
            } );
        }

    }

    protected function routeConfiguration() {
        return [
            'middleware' => config( 'hello-one-socialite.routes.middleware' ),
            'prefix'     => config( 'hello-one-socialite.routes.prefix' ),
        ];
    }

    private function bootSpotifySocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'hello-one-guest',
            function ($app) use ($socialite) {
                $config = [
                    'client_id' => $app['config']['hello-one-socialite.client_id'],
                    'client_secret' => $app['config']['hello-one-socialite.client_secret'],
                    'redirect' =>  $app['config']['hello-one-socialite.login_url']
                ];
                return $socialite->buildProvider(HelloOneGuestProvider::class, $config);
            }
        );
    }

}
