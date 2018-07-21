<?php

namespace KiliCow\Edukcate;

class Edukcate
{
    use Configuration\ManagesAppDetails,
    use Configuration\ManagesAppOptions,
        Configuration\ManagesModelOptions;

    /**
     * The Edukcate version.
     */
    public static $version = '0.0.11';
}
