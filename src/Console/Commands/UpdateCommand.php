<?php

namespace KiliCow\Edukcate\Console\Commands;

use KiliCow\Edukcate\Edukcate;
use Illuminate\Console\Command;
use KiliCow\Edukcate\Console\Updating;

class UpdateCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'edukcate:update
                            {--major : Update Edukcate to the latest major release.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the Edukcate installation';

    /**
     * The target Edukcate major version number.
     *
     * @var string
     */
    protected $targetMajorVersion;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->targetMajorVersion = $this->option('major')
                    ? null : explode('.', Edukcate::$version)[0];

        if ($this->onLatestRelease()) {
            return $this->info('You are already running the latest release of Edukcate.');
        }

        $downloadPath = (new Updating\DownloadRelease($this))->download(
            $release = $this->latestEdukcateRelease($this->targetMajorVersion)
        );

        $updaters = collect([
            Updating\UpdateViews::class,
            Updating\UpdateInstallation::class,
            Updating\RemoveDownloadPath::class,
        ]);

        $updaters->each(function ($updater) use ($downloadPath) {
            (new $updater($this, $downloadPath))->update();
        });

        $this->info('You are now running on Edukcate v'.$release.'. Enjoy!');
    }

    /**
     * Determine if the application is already on the latest version.
     *
     * @return bool
     */
    protected function onLatestRelease()
    {
        return version_compare(
            Edukcate::$version, $this->latestEdukcateRelease($this->targetMajorVersion), '>='
        );
    }
}
