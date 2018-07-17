<?php

namespace KiliCow\Edukcate\Console\Commands;

use Illuminate\Console\Command;
use KiliCow\Edukcate\Console\Installation;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'edukcate:install
                    {--force : Force Edukcate to install even it has been already installed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Edukcate scaffolding into the application';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! defined('EDUKCATE_STUB_PATH')) {
            define('EDUKCATE_STUB_PATH', EDUKCATE_PATH.'/install-stubs');
        }

        if ($this->edukcateAlreadyInstalled() && ! $this->option('force')) {
            return $this->line('Edukcate is already installed for this project.');
        }

        $installers = collect([
            Installation\InstallConfiguration::class,
            Installation\InstallEnvironment::class,
            Installation\InstallHttp::class,
            Installation\InstallImages::class,
            Installation\InstallMigrations::class,
            Installation\InstallModels::class,
            Installation\InstallProviders::class,
            Installation\InstallResources::class,
        ]);

        $installers->each(function ($installer) { (new $installer($this))->install(); });

        $this->comment('KiliCow Edukcate installed. Create something amazing!');
    }

    /**
     * Determine if Edukcate is already installed.
     *
     * @return bool
     */
    protected function edukcateAlreadyInstalled()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        return isset($composer['require']['kilicow/edukcate']);
    }
}
