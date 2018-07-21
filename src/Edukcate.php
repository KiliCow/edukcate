<?php

namespace KiliCow\Edukcate;

class Edukcate
{
    use Configuration\ManagesApiOpetions,
    	Configuration\ManagesAppDetails,
    	Configuration\ManagesAppOptions,
        Configuration\ManagesModelOptions,
        Configuration\ManagesSupportOptions;

    /**
     * The Edukcate version.
     */
    public static $version = '0.0.12';
}
