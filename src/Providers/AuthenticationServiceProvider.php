<?php

namespace JobMetric\Authentication\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use JobMetric\Authentication\AuthenticationService;

class AuthenticationServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'JobMetric\Authentication\Http\Controller';

    /**
     * register provider
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('AuthenticationService', function ($app) {
            return new AuthenticationService;
        });
    }

    /**
     * boot provider
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishable();

        // set translations
        $this->loadTranslationsFrom(realpath(__DIR__.'/../../lang'), 'authentication');

        // set route
        Route::prefix('auth')->name('authentication.')->namespace($this->namespace)->group(realpath(__DIR__.'/../../routes/route.php'));
    }

    /**
     * publishable data
     *
     * @return void
     */
    private function publishable(): void
    {
    }
}
