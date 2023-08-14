<?php

namespace Dsoloview\YandexCaptcha;

use Dsoloview\YandexCaptcha\View\Components\ExtendedYandexCaptchaComponent;
use Dsoloview\YandexCaptcha\View\Components\YandexCaptchaComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelProvider extends ServiceProvider
{
    public function boot(){

        $this->loadViewsFrom(__DIR__.'/resources/views/components', 'dsoloview');

        $this->publishes([
            __DIR__.'/resources/views/components' => resource_path('views/vendor/dsoloview'),
        ], 'yandex-captcha-view');

        $this->publishes([
            __DIR__ . "/config/yandex_captcha.php" => config_path('yandex_captcha.php'),
        ], 'yandex-captcha-config');

        Blade::component('yandex-captcha', YandexCaptchaComponent::class);
        Blade::component('extended-yandex-captcha', ExtendedYandexCaptchaComponent::class);
    }

    public function register()
    {
    }
}
