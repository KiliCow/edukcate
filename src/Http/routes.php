<?php

$router->group(['middleware' => 'web'], function ($router) {
    // Terms Of Service...
    $router->get('/terms', 'TermsController@show')->name('terms');

    // Customer Support...
    $router->post('/support/email', 'SupportController@sendEmail');

    // API Token Refresh...
    $router->put('/edukcate/token', 'TokenController@refresh');

    // Users...
    $router->get('/user/current', 'UserController@current');
    $router->put('/user/last-read-announcements-at', 'UserController@updateLastReadAnnouncementsTimestamp');

    // Notifications
    $router->get('/notifications/recent', 'NotificationController@recent');
    $router->put('/notifications/read', 'NotificationController@markAsRead');

    // Settings Dashboard...
    $router->get('/settings', 'Settings\DashboardController@show')->name('settings');

    // Profile Contact Information...
    $router->put('/settings/contact', 'Settings\Profile\ContactInformationController@update');

    // Profile Photo...
    $router->post('/settings/photo', 'Settings\Profile\PhotoController@store');

    // Security Settings...
    $router->put('/settings/password', 'Settings\Security\PasswordController@update');
    $router->post('/settings/two-factor-auth', 'Settings\Security\TwoFactorAuthController@enable');
    $router->delete('/settings/two-factor-auth', 'Settings\Security\TwoFactorAuthController@disable');

    // API Settings
    $router->get('/settings/api/tokens', 'Settings\API\TokenController@all');
    $router->post('/settings/api/token', 'Settings\API\TokenController@store');
    $router->put('/settings/api/token/{token_id}', 'Settings\API\TokenController@update');
    $router->get('/settings/api/token/abilities', 'Settings\API\TokenAbilitiesController@all');
    $router->delete('/settings/api/token/{token_id}', 'Settings\API\TokenController@destroy');

    // Authentication...
    $router->get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    $router->post('/login', 'Auth\LoginController@login');
    $router->get('/logout', 'Auth\LoginController@logout')->name('logout');

    // Registration...
    $router->get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $router->post('/register', 'Auth\RegisterController@register');

    // Password Reset...
    $router->get('/password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('password.reset');
    $router->post('/password/email', 'Auth\PasswordController@sendResetLinkEmail');
    $router->post('/password/reset', 'Auth\PasswordController@reset');
});


// Geocoding...
$router->get('/geocode/country', 'GeocodingController@country');
$router->get('/geocode/states/{country}', 'GeocodingController@states');
