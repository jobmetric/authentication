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
        Route::name('authentication.')->namespace($this->namespace)->group(realpath(__DIR__.'/../../routes/route.php'));
    }

    /**
     * publishable data
     *
     * @return void
     */
    private function publishable(): void
    {
        // publish config
        $this->publishes([
            realpath(__DIR__.'/../../config/config.php') => config_path('authentication.php')
        ], 'config');

        // publish views
        $this->publishes([
            realpath(__DIR__.'/../../resources/views') => resource_path('views/vendor/authentication')
        ], 'views');

        // publish migration
        if (!$this->migrationExists('create_users_table')) {
            $this->publishes([
                realpath(__DIR__.'/../../database/migrations/00_create_users_table.php.stub') => database_path('migrations/'.date('Y_m_d_His', time()).'_00_create_users_table.php')
            ], 'migrations');
        }

        if (!$this->migrationExists('create_user_metas_table')) {
            $this->publishes([
                realpath(__DIR__.'/../../database/migrations/01_create_user_metas_table.php.stub') => database_path('migrations/'.date('Y_m_d_His', time()).'_01_create_user_metas_table.php')
            ], 'migrations');
        }

        if (!$this->migrationExists('create_user_groups_table')) {
            $this->publishes([
                realpath(__DIR__.'/../../database/migrations/02_create_user_groups_table.php.stub') => database_path('migrations/'.date('Y_m_d_His', time()).'_02_create_user_groups_table.php')
            ], 'migrations');
        }

        if (!$this->migrationExists('create_user_group_paths_table')) {
            $this->publishes([
                realpath(__DIR__.'/../../database/migrations/03_create_user_group_paths_table.php.stub') => database_path('migrations/'.date('Y_m_d_His', time()).'_03_create_user_group_paths_table.php')
            ], 'migrations');
        }

        if (!$this->migrationExists('create_user_otps_table')) {
            $this->publishes([
                realpath(__DIR__.'/../../database/migrations/04_create_user_otps_table.php.stub') => database_path('migrations/'.date('Y_m_d_His', time()).'_04_create_user_otps_table.php')
            ], 'migrations');
        }

        if (!$this->migrationExists('create_user_tokens_table')) {
            $this->publishes([
                realpath(__DIR__.'/../../database/migrations/05_create_user_tokens_table.php.stub') => database_path('migrations/'.date('Y_m_d_His', time()).'_05_create_user_tokens_table.php')
            ], 'migrations');
        }
    }

    private function migrationExists($migration)
    {
        $path = database_path('migrations/');
        $files = scandir($path);

        $position = false;
        foreach ($files as &$value) {
            $position = strpos($value, $migration);
            if ($position !== false) {
                return true;
            }
        }

        return false;
    }
}
