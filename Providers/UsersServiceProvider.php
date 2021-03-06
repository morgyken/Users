<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Users\Providers;

use Cartalyst\Sentinel\Laravel\SentinelServiceProvider;
use Ignite\Core\Contracts\Authentication;
use Ignite\Users\Library\SentinelAuthentication;
use Ignite\Users\Library\SentinelRoleRepository;
use Ignite\Users\Library\SentinelUserRepository;
use Ignite\Users\Library\UsersFunctions;
use Ignite\Users\Repositories\MyUsers;
use Ignite\Users\Repositories\RoleRepository;
use Ignite\Users\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @var string
     */
    protected $driver = 'Sentinel';

    /**
     * @var array
     */
    protected $providers = [
        'Sentinel' => SentinelServiceProvider::class,
            //'Sentry' => \Cartalyst\Sentry\SentryServiceProvider::class
    ];

    /**
     * @var array
     */
    protected $middleware = [
        'Users' => [
            'auth.guest' => 'GuestMiddleware',
            'logged.in' => 'LoggedInMiddleware'
        ],
    ];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot() {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerMiddleware();
        $this->registerBindings();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->register(
                $this->providers[$this->driver]
        );
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig() {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('users.php'),
        ]);
        $this->mergeConfigFrom(
                __DIR__ . '/../Config/config.php', 'users'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews() {
        $viewPath = base_path('resources/views/modules/users');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                            return $path . '/modules/users';
                        }, \Config::get('view.paths')), [$sourcePath]), 'users');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations() {
        $langPath = base_path('resources/lang/modules/users');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'users');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'users');
        }
    }

    private function registerBindings() {
        $this->app->bind(UserRepository::class, SentinelUserRepository::class);
        $this->app->bind(RoleRepository::class, SentinelRoleRepository::class);
        $this->app->bind(Authentication::class, SentinelAuthentication::class);
        $this->app->bind(MyUsers::class, UsersFunctions::class);
    }

    private function registerMiddleware() {
        foreach ($this->middleware as $module => $middlewares) {
            foreach ($middlewares as $name => $middleware) {
                $class = "Ignite\\{$module}\\Http\\Middleware\\{$middleware}";
                $this->app['router']->middleware($name, $class);
            }
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

}
