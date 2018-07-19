<?php

namespace KiliCow\Edukcate\Configuration;

trait ManagesAppOptions
{
    /**
     * Where to redirect users after authentication.
     *
     * @var string
     */
    public static $afterLoginRedirectTo = '/home';

    /**
     * Indicates if we should show the team switcher.
     *
     * @var bool
     */
    public static $showTeamSwitcher = true;

    /**
     * Indicates that users can create additional teams from the dashboard.
     *
     * @var bool
     */
    public static $createsAdditionalTeams = true;

    /**
     * The prefix used in the URI to describe teams.
     *
     * @var string
     */
    public static $teamsPrefix = 'teams';

    /**
     * Minimum length a user given password can be.
     *
     * @var string
     */
    public static $minimumPasswordLength = 6;

    /**
     * Indicates that the application should use the right-to-left theme.
     *
     * @var bool
     */
    public static $usesRightToLeftTheme = false;

    /**
     * Where to redirect users after authentication.
     *
     * @return string
     */
    public static function afterLoginRedirect()
    {
        return value(static::$afterLoginRedirectTo);
    }

    /**
     * Set the path to redirect to after authentication.
     *
     * @return void
     */
    public static function afterLoginRedirectTo($path)
    {
        static::$afterLoginRedirectTo = $path;
    }

    /**
     * Get or set the minimum length a user given password can be.
     *
     * @param  string|null  $length
     * @return string
     */
    public static function minimumPasswordLength($length = null)
    {
        if (is_null($length)) {
            return static::$minimumPasswordLength;
        } else {
            static::$minimumPasswordLength = $length;

            return new static;
        }
    }

}
