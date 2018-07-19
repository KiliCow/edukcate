<?php

namespace KiliCow\Edukcate\Console\Commands;

use Illuminate\Console\Command;
use KiliCow\Edukcate\Console\Updating;

class UpdateViewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'edukcate:update-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the Edukcate views';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $updaters = collect([
            Updating\UpdateViews::class,
        ]);

        $updaters->each(function ($updater) {
            (new $updater($this, EDUKCATE_PATH))->update();
        });
    }
}
