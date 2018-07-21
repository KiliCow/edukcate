<?php

namespace KiliCow\Edukcate\Configuration;

use Illuminate\Support\HtmlString;

trait ManagesAppDetails
{
    /**
     * The application / product details.
     *
     * @var array
     */
    public static $details = [];

    /**
     * Define the application information.
     *
     * @param  array  $details
     * @return void
     */
    public static function details(array $details)
    {
        static::$details = $details;
    }

    /**
     * Get the product name from the application information.
     *
     * @return string
     */
    public static function product()
    {
        return static::$details['product'];
    }

}
