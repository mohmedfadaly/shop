<?php

namespace App\Providers;
use App\models\Img;
use App\models\Prov;
use App\models\Serv;
use App\models\Bank;
use App\models\Not;
use App\models\Section;
use App\models\Req_serv;
use App\models\City;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->share('cities' , City::get());
        view()->share('sections' , Section::get());
        view()->share('images' , Img::get());
        view()->share('providers' , Prov::get());
        view()->share('notices' , Not::get());
        view()->share('Servs' , Serv::get());
        view()->share('banks' , Bank::get());
        view()->share('Req_servs' , Req_serv::get());
    }
}
