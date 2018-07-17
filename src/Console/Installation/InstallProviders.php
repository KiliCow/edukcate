<?php

namespace KiliCow\Edukcate\Console\Installation;

class InstallProviders
{
    /**
     * The console command instance.
     *
     * @var \Illuminate\Console\Command  $command
     */
    protected $command;

    /**
     * Create a new installer instance.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function __construct($command)
    {
        $this->command = $command;

        $this->command->line('Installing Service Providers: <info>✔</info>');
    }

    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        copy(
            EDUKCATE_STUB_PATH.'/app/Providers/EventServiceProvider.php',
            app_path('Providers/EventServiceProvider.php')
        );

        copy(
            EDUKCATE_STUB_PATH.'/app/Providers/RouteServiceProvider.php',
            app_path('Providers/RouteServiceProvider.php')
        );

        copy(
            EDUKCATE_STUB_PATH.'/app/Providers/SparkServiceProvider.php',
            $providerPath = app_path('Providers/EdukcateServiceProvider.php')
        );
    }

}
