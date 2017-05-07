<?php namespace PatreonLaravel;

use Illuminate\Support\ServiceProvider;
use PatreonLaravel\API\PatreonAPI;
use PatreonLaravel\OAuth\PatreonOAuth;

class PatreonServiceProvider extends ServiceProvider
{

    /*
     * Publish config files
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('patreon-laravel.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(PatreonOAuth::class, function ($app) {
            $oauth = new PatreonOAuth();
            return $oauth;
        });

        $this->app->singleton(PatreonAPI::class, function ($app) {
            $api_client = new PatreonAPI();
            return $api_client;
        });
    }
}