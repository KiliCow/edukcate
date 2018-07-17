<?php

namespace KiliCow\Edukcate;

use Illuminate\Support\Str;
use GuzzleHttp\Client as HttpClient;

trait InteractsWithGithubApi
{
    /**
     * Get the latest Spark release version.
     *
     * @param  string|null  $major
     * @return string
     */
    protected function latestEdukcateRelease($major = null)
    {
        $response = json_decode((string) (new HttpClient)->get(
            $this->sparkUrl.'/api/releases/all-versions'
        )->getBody());

        return collect($response)->filter(function ($version) use ($major) {
            return ! $major || Str::startsWith($version, $major);
        })->sort('version_compare')->last();
    }

    /**
     * The Spark base URL.
     *
     * @var string
     */
    protected $sparkUrl = 'https://api.github.com';
}
