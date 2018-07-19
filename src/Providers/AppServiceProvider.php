<?php

namespace KiliCow\Edukcate\Providers;

use KiliCow\Edukcate\Edukcate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [];

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * The available team member roles.
     *
     * @var array
     */
    protected $roles = [];

    /**
     * Indicates if two-factor authentication should be offered.
     *
     * @var bool
     */
    protected $usesTwoFactorAuth = false;

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * All of the abilities that may be assigned to API tokens.
     *
     * @var array
     */
    protected $tokensCan = [];

    /**
     * The token abilities that should be selected by default in the UI.
     *
     * @var array
     */
    protected $byDefaultTokensCan = [];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Edukcate::details($this->details);

        Edukcate::sendSupportEmailsTo($this->sendSupportEmailsTo);

        if (count($this->roles) > 0) {
            Edukcate::useRoles($this->roles);
        }

        if ($this->usesApi) {
            Edukcate::useApi();
        }

        Edukcate::tokensCan($this->tokensCan);

        Edukcate::byDefaultTokensCan($this->byDefaultTokensCan);

        $this->booted();

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
