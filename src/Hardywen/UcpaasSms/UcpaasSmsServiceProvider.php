<?php namespace Hardywen\UcpaasSms;

use Illuminate\Support\ServiceProvider;

class UcpaasSmsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__.'/../../config/ucpaas.php');

        $this->publishes([$source => config_path('ucpaas.php')]);

        $this->mergeConfigFrom($source, 'ucpaas');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['ucpaas-sms'] = $this->app->share(function ($app) {
            return new UcpaasSms();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ucpaas-sms'];
    }

}
