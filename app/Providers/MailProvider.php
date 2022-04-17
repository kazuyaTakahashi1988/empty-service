<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindMethod(MailJob::class.'@handle',
            function($job, $app){
                return $job->handle();
            });

        // php arisan make:provider MailProvider
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
