<?php

namespace KiliCow\Edukcate;

class Edukcate
{
    use Configuration\ManagesApiOptions,
    	Configuration\ManagesAppDetails,
    	Configuration\ManagesAppOptions,
        Configuration\ManagesModelOptions,
        Configuration\ManagesSupportOptions;

    /**
     * The Edukcate version.
     */
    public static $version = '0.0.12';
}
