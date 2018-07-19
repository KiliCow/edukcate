<?php

namespace KiliCow\Edukcate\Providers;

use KiliCow\Edukcate\Edukcate;
use KiliCow\Edukcate\TokenGuard;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use KiliCow\Edukcate\Validation\StateValidator;
use KiliCow\Edukcate\Validation\CountryValidator;
use KiliCow\Edukcate\Console\Commands\InstallCommand;
use KiliCow\Edukcate\Console\Commands\UpdateCommand;
use KiliCow\Edukcate\Console\Commands\VersionCommand;
use KiliCow\Edukcate\Console\Commands\UpdateViewsCommand;

class EdukcateServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->defineRoutes();

        $this->defineResources();

        Validator::extend('state', StateValidator::class.'@validate');
        Validator::extend('country', CountryValidator::class.'@validate');

        Auth::viaRequest('edukcate', function ($request) {
            return app(TokenGuard::class)->user($request);
        });
    }

    /**
     * Define the Edukcate routes.
     *
     * @return void
     */
    protected function defineRoutes()
    {
        $this->defineRouteBindings();

        // If the routes have not been cached, we will include them in a route group
        // so that all of the routes will be conveniently registered to the given
        // controller namespace. After that we will load the Edukcate routes file.
        if (! $this->app->routesAreCached()) {
            Route::group([
                'namespace' => 'KiliCow\Edukcate\Http\Controllers'],
                function ($router) {
                    require __DIR__.'/../Http/routes.php';
                }
            );
        }
    }

    /**
     * Define the Edukcate route model bindings.
     *
     * @return void
     */
    protected function defineRouteBindings()
    {

        Route::model('team_member', Edukcate::userModel());
    }

    /**
     * Define the resources for the package.
     *
     * @return void
     */
    protected function defineResources()
    {
        $this->loadViewsFrom(EDUKCATE_PATH.'/resources/views', 'edukcate');

        $this->loadTranslationsFrom(EDUKCATE_PATH.'/resources/lang', 'edukcate');

        if ($this->app->runningInConsole()) {
            $this->defineViewPublishing();

            $this->defineAssetPublishing();

            $this->defineLanguagePublishing();

            $this->defineFullPublishing();
        }
    }

    /**
     * Define the view publishing configuration.
     *
     * @return void
     */
    public function defineViewPublishing()
    {
        $this->publishes([
            EDUKCATE_PATH.'/resources/views' => resource_path('views/vendor/edukcate'),
        ], 'edukcate-views');
    }

    /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    public function defineAssetPublishing()
    {
        $this->publishes([
            EDUKCATE_PATH.'/resources/assets/js' => resource_path('assets/js/edukcate'),
        ], 'edukcate-js');

        $this->publishes([
            EDUKCATE_PATH.'/resources/assets/sass' => resource_path('assets/sass/edukcate'),
        ], 'edukcate-sass');
    }

    /**
     * Define the language publishing configuration.
     *
     * @return void
     */
    public function defineLanguagePublishing()
    {
        $this->publishes([
            EDUKCATE_PATH.'/install-stubs/resources/lang' => resource_path('lang'),
        ], 'edukcate-lang');
    }

    /**
     * Define the "full" publishing configuration.
     *
     * @return void
     */
    public function defineFullPublishing()
    {
        $this->publishes([
            EDUKCATE_PATH.'/resources/views' => resource_path('views/vendor/edukcate'),
            EDUKCATE_PATH.'/resources/assets/js' => resource_path('assets/js/edukcate'),
            EDUKCATE_PATH.'/resources/assets/sass' => resource_path('assets/sass/edukcate'),
            EDUKCATE_PATH.'/install-stubs/resources/lang' => resource_path('lang'),
        ], 'edukcate-full');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (! defined('EDUKCATE_PATH')) {
            define('EDUKCATE_PATH', realpath(__DIR__.'/../../'));
        }

        if (! class_exists('Edukcate')) {
            class_alias('KiliCow\Edukcate\Edukcate', 'Edukcate');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UpdateCommand::class,
                UpdateViewsCommand::class,
                VersionCommand::class,
            ]);
        }

        $this->registerServices();
    }

    /**
     * Register the Edukcate services.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->registerAuthyService();

        $this->registerInterventionService();

        $this->registerApiTokenRepository();

        $services = [
            'Contracts\Http\Requests\Auth\RegisterRequest' => 'Http\Requests\Auth\StripeRegisterRequest',
            'Contracts\Http\Requests\Settings\Subscription\CreateSubscriptionRequest' => 'Http\Requests\Settings\Subscription\CreateStripeSubscriptionRequest',
            'Contracts\Http\Requests\Settings\PaymentMethod\UpdatePaymentMethodRequest' => 'Http\Requests\Settings\PaymentMethod\UpdateStripePaymentMethodRequest',
            'Contracts\Repositories\AnnouncementRepository' => 'Repositories\AnnouncementRepository',
            'Contracts\Repositories\CouponRepository' => 'Repositories\StripeCouponRepository',
            'Contracts\Repositories\NotificationRepository' => 'Repositories\NotificationRepository',
            'Contracts\Repositories\UserRepository' => 'Repositories\UserRepository',
            'Contracts\Repositories\LocalInvoiceRepository' => 'Repositories\StripeLocalInvoiceRepository',
            'Contracts\Repositories\PerformanceIndicatorsRepository' => 'Repositories\PerformanceIndicatorsRepository',
            'Contracts\Repositories\Geography\StateRepository' => 'Repositories\Geography\StateRepository',
            'Contracts\Repositories\Geography\CountryRepository' => 'Repositories\Geography\CountryRepository',
            'Contracts\InitialFrontendState' => 'InitialFrontendState',
            'Contracts\Interactions\Support\SendSupportEmail' => 'Interactions\Support\SendSupportEmail',
            'Contracts\Interactions\Subscribe' => 'Interactions\SubscribeUsingStripe',
            'Contracts\Interactions\CheckPlanEligibility' => 'Interactions\CheckPlanEligibility',
            'Contracts\Interactions\Auth\CreateUser' => 'Interactions\Auth\CreateUser',
            'Contracts\Interactions\Auth\Register' => 'Interactions\Auth\Register',
            'Contracts\Interactions\Settings\Profile\UpdateProfilePhoto' => 'Interactions\Settings\Profile\UpdateProfilePhoto',
            'Contracts\Interactions\Settings\Profile\UpdateContactInformation' => 'Interactions\Settings\Profile\UpdateContactInformation',
            'Contracts\Interactions\Settings\Security\EnableTwoFactorAuth' => 'Interactions\Settings\Security\EnableTwoFactorAuthUsingAuthy',
            'Contracts\Interactions\Settings\Security\VerifyTwoFactorAuthToken' => 'Interactions\Settings\Security\VerifyTwoFactorAuthTokenUsingAuthy',
            'Contracts\Interactions\Settings\Security\DisableTwoFactorAuth' => 'Interactions\Settings\Security\DisableTwoFactorAuthUsingAuthy',
            'Contracts\Interactions\Settings\PaymentMethod\UpdatePaymentMethod' => 'Interactions\Settings\PaymentMethod\UpdateStripePaymentMethod',
            'Contracts\Interactions\Settings\PaymentMethod\RedeemCoupon' => 'Interactions\Settings\PaymentMethod\RedeemStripeCoupon',
        ];

        foreach ($services as $key => $value) {
            $this->app->singleton('KiliCow\Edukcate\\'.$key, 'KiliCow\Edukcate\\'.$value);
        }
    }

    /**
     * Register the Authy service.
     *
     * @return void
     */
    protected function registerAuthyService()
    {
        $this->app->when('KiliCow\Edukcate\Services\Security\Authy')
                ->needs('$key')
                ->give(function () {
                    return config('services.authy.secret');
                });
    }

    /**
     * Register the Intervention image manager binding.
     *
     * @return void
     */
    protected function registerInterventionService()
    {
        $this->app->bind(ImageManager::class, function () {
            return new ImageManager(['driver' => 'gd']);
        });
    }

    /**
     * Register the Api Token repository.
     *
     * @return void
     */
    private function registerApiTokenRepository()
    {
        $concrete = class_exists('Laravel\Passport\Passport')
                        ? 'KiliCow\Edukcate\Repositories\PassportTokenRepository'
                        : 'KiliCow\Edukcate\Repositories\TokenRepository';

        $this->app->singleton('KiliCow\Edukcate\Contracts\Repositories\TokenRepository', $concrete);
    }
}
