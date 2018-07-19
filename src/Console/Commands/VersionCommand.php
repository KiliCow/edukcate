<?php

namespace Laravel\Spark\Console\Commands;

use KiliCow\Edukcate\Edukcate;
use Illuminate\Console\Command;

class VersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'edukcate:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View the current Edukcate version';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('<info>KiliCow Edukcate</info> version <comment>'.Edukcate::$version.'</comment>');
    }
}
