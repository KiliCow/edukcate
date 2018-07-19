<?php

namespace KiliCow\Edukcate\Console\Updating;

use Illuminate\Filesystem\Filesystem;

class UpdateInstallation
{
    /**
     * The path to the downloaded Edukcate upgrade.
     *
     * @var string
     */
    protected $downloadPath;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Console\Command  $command
     * @param  string  $downloadPath
     * @return void
     */
    public function __construct($command, $downloadPath)
    {
        $this->downloadPath = $downloadPath;

        $command->line('Updating Edukcate Directory: <info>✔</info>');
    }

    /**
     * Update the components.
     *
     * @return void
     */
    public function update()
    {
        (new Filesystem)->deleteDirectory(EDUKCATE_PATH);

        rename($this->downloadPath, EDUKCATE_PATH);
    }
}
