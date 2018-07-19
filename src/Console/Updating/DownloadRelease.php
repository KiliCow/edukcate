<?php

namespace KiliCow\Edukcate\Console\Updating;

use ZipArchive;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Filesystem\Filesystem;
use GuzzleHttp\Exception\ClientException;

class DownloadRelease
{

    /**
     * The command instance.
     *
     * @var \Illuminate\Console\Command
     */
    protected $command;

    /**
     * Create a new downloader instance.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function __construct($command)
    {
        $this->command = $command;
    }


    /**
     * Download the latest Edukcate release.
     *
     * @return void
     */
    protected function downloadZip()
    {
        $this->command->output->writeln(
            '<info>Downloading Edukcate...</info>'
        );

        $response = (new HttpClient)->get($this->zipResponse())->getBody();

        file_put_contents(
            $zipPath = $this->command->path.'/edukcate-archive.zip', $response
        );

        return $zipPath;
    }

    /**
     * Get the raw Zip response for a Edukcate download.
     *
     * @return string
     */
    protected function zipResponse()
    {

        try {
            
            $json = (string) (new HttpClient)->get(
                'https://api.github.com/repos/kilicow/edukcate/releases/latest',
                [
                    'headers' => [
                        'X-Requested-With' => 'XMLHttpRequest',
                    ],
                    'verify' => __DIR__.'/../cacert.pem',
                ]
            )->getBody();

            return json_decode($json)->zipball_url;

        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 401) {
                $this->invalidRelease();
            }

            throw $e;
        }
    }

    /**
     * Extract the Edukcate Zip archive.
     *
     * @param  string  $zipPath
     * @return void
     */
    protected function extractZip($zipPath)
    {
        $archive = new ZipArchive;

        $archive->open($zipPath);

        $archive->extractTo($this->command->path.'/edukcate-new');

        $archive->close();

        @unlink($zipPath);
    }

    /**
     * Get the release directory.
     *
     * @return string
     */
    protected function releasePath()
    {
        return $this->command->path.'/edukcate-new/'.basename(
            (new Filesystem)->directories($this->command->path.'/edukcate-new')[0]
        );
    }

    /**
     * Inform the user that their Edukcate download is invalid.
     *
     * @return void
     */
    protected function invalidRelease()
    {
        $this->command->output->writeln(
            '<fg=red>There was an issue identifying the latest release.</>'
        );

        exit(1);
    }
}
