<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'modules\Students\Interfaces\StudentInterface',
            'modules\Students\Repositories\StudentRepository',
        );

        $this->app->bind(
            'modules\Admins\Interfaces\AdminInterface',
            'modules\Admins\Repositories\AdminRepository',
        );

        $this->app->bind(
            'modules\Schools\Interfaces\SchoolInterface',
            'modules\Schools\Repositories\SchoolRepository',
        );


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
