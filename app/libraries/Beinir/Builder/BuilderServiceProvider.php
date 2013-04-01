<?php namespace Beinir\Builder;

use Illuminate\Support\ServiceProvider;

class BuilderServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('Beinir\Builder\BuilderInterface', 'Beinir\Builder\Builder');
    }

}
