<?php namespace Library;

use Illuminate\Support\ServiceProvider;

class CryptRC4ServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register 'parsecsv' instance container to our ParseCSV object
        $this->app['cryptrc4'] = $this->app->share(function($app)
        {
            return new CryptRC4;
        });
    }
}