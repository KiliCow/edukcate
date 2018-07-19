<?php

namespace KiliCow\Edukcate\Configuration;

trait ManagesModelOptions
{
    /**
     * The user model class name.
     *
     * @var string
     */
    public static $userModel = 'App\User';

    /**
     * The team model class name.
     *
     * @var string
     */
    public static $teamModel = 'App\Team';

    /**
     * Set the user model class name.
     *
     * @param  string  $userModel
     * @return void
     */
    public static function useUserModel($userModel)
    {
        static::$userModel = $userModel;
    }

    /**
     * Get the user model class name.
     *
     * @return string
     */
    public static function userModel()
    {
        return static::$userModel;
    }

    /**
     * Get a new user model instance.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public static function user()
    {
        return new static::$userModel;
    }

    /**
     * Set the team model class name.
     *
     * @param  string  $teamModel
     * @return void
     */
    public static function useTeamModel($teamModel)
    {
        static::$teamModel = $teamModel;
    }

    /**
     * Get the team model class name.
     *
     * @return string
     */
    public static function teamModel()
    {
        return static::$teamModel;
    }

    /**
     * Get a new team model instance.
     *
     * @return \KiliCow\Edukcate\Team
     */
    public static function team()
    {
        return new static::$teamModel;
    }
}
