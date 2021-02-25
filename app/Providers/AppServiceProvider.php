<?php

namespace App\Providers;

use App\HeaderFooter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer('admin.includes.header', function($view){
            $users = Auth::user();
            $header = HeaderFooter::first();
            $view->with([
                'users'=>$users,
                'header'=>$header,
            ]);
        });
        View::composer('admin.includes.menu', function($view){
            $users = Auth::user();
            $header = HeaderFooter::first();
            $view->with([
                'users'=>$users,
                'header'=>$header,
            ]);
        });
        View::composer('admin.includes.footer', function($view){
            $footer = DB::table('header_footers')->first();
            $view->with([
                'footer'=>$footer,
            ]);
        });

    }
}
