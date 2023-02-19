<?php

namespace Dsoloview\YandexCaptcha\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class YandexCaptchaComponent extends Component
{
    public string $clientKey;

    public function __construct()
    {
        $this->clientKey = config('yandex_captcha.client_key') ?? '';
    }

    public function render(): View
    {
        return view('dsoloview::yandex-captcha');
    }
}
