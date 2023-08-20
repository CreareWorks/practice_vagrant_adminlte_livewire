<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OwnServiseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //サービスコンテナにサービスを登録するコードを記述
        //下記の'myName'の部分が呼び出す時のプロバイダ名となる。
        app()->bind('myName', function(){
            return 'youta';
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //すべてのサービスプロバイダーが読み込まれたあとに実行したいコードを記述

    }
}
