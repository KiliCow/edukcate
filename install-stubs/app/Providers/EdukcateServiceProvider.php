<?php

namespace App\Providers;

use KiliCow\Edukcate\Edukcate;
use KiliCow\Edukcate\Providers\AppServiceProvider as ServiceProvider;

class EdukcateServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
        'street' => 'PO Box 111',
        'location' => 'Your Town, NY 12345',
        'phone' => '555-555-5555',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Epark for the application.
     *
     * @return void
     */
    public function booted()
    {
 
    }
}
