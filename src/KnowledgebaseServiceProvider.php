<?php

namespace Abby\Knowledgebase;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class KnowledgebaseServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // publish views
        $this->publishes([__DIR__.'/resources/views' => base_path('resources/views')], 'views');

        // publish translation files
        $this->publishes([__DIR__.'/resources/lang' => resource_path('lang/vendor/backpack')], 'lang');

        // publish migrations
        $this->publishes([__DIR__.'/database/migrations' => database_path('migrations')], 'migrations');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Abby\Knowledgebase\app\Http\Controllers'], function ($router) {
            \Route::group(['prefix' => config('backpack.base.route_prefix', 'admin').'/knowledgebase', 'middleware' => ['web', 'admin'], 'namespace' => 'Admin'], function () {
                \CRUD::resource('space', 'SpaceCrudController');
                \CRUD::resource('article', 'ArticleCrudController')->with(function() {
                    \Route::get('article/{id}/export/word', 'ArticleCrudController@exportWord');
                    \Route::get('article/{id}/export/pdf', 'ArticleCrudController@exportPDF');
                });;
            });
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // register its dependencies
        $this->app->register(\Cviebrock\EloquentSluggable\ServiceProvider::class);

        $this->setupRoutes($this->app->router);
    }
}
