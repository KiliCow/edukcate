<?php

namespace KiliCow\Edukcate\Console\Installation;

class InstallModels
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

        $this->command->line('Installing Eloquent Models: <info>✔</info>');
    }

    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        copy($this->getUserModel(), app_path('User.php'));

        copy(EDUKCATE_STUB_PATH.'/app/Team.php', app_path('Team.php'));
    }

    /**
     * Get the path to the proper User model stub.
     *
     * @return string
     */
    protected function getUserModel()
    {
        return $this->command->option('team-billing')
                            ? EDUKCATE_STUB_PATH.'/app/TeamUser.php'
                            : EDUKCATE_STUB_PATH.'/app/User.php';
    }
}
