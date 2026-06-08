<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/common.php'));

            // PROTECT ROUTES BY ROLE
            Route::group(['middleware' => 'web', 'auth'], function () {

                Route::middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('admin|comite'))
                    ->prefix('admin')
                    ->group(base_path('routes/admin.php'));

                Route::middleware([
                    'auth:sanctum',
                    config('jetstream.auth_session'),
                    'verified',
                ])->group(base_path('routes/user-common.php'));

                Route::middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('solicitante|inscrito|admin'))
                    ->group(base_path('routes/desarrollo.php'));

                Route::middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('slate|admin'))
                    ->group(base_path('routes/slate.php'));

            });
        });
    }
}
