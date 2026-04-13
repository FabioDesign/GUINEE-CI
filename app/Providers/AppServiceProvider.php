<?php

namespace App\Providers;

use App\Models\Town;
use App\Models\File;
use App\Models\Profile;
use App\Observers\ModelObserver;
use Illuminate\Support\ServiceProvider;
// import builder where defaultStringLength method is defined
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix for MySQL < 5.7.7 and MariaDB < 10.2.2
        Schema::defaultStringLength(191); //Update defaultStringLength
        Town::observe(ModelObserver::class);
        File::observe(ModelObserver::class);
        Profile::observe(ModelObserver::class);
    }
}
