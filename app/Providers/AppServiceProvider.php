<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Common\Language;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Blade::directive('hello', function ($html) {
                   return "<?php echo $html ?>";
        });


    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
