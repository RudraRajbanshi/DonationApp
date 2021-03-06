<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_pages.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_cause.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_donation.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_story.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_blog.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_news.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_gallery.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_event.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_setting.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_organization.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Backend')
             ->group(base_path('routes/backend/route_comment.php'));

        Route::middleware('web')
             ->namespace('App\Http\Controllers\Frontend')
             ->group(base_path('routes/frontend/route_home.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
