<?php

namespace KiliCow\Edukcate;

class Edukcate
{
    use Configuration\ManagesAppDetails,
    	Configuration\ManagesAppOptions,
        Configuration\ManagesModelOptions;

    /**
     * The Edukcate version.
     */
    public static $version = '0.0.11';
}
