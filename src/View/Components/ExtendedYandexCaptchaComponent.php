<?php

namespace Dsoloview\YandexCaptcha\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExtendedYandexCaptchaComponent extends Component
{
    public function __construct(
        public bool $invisible = false,
        public string $lang = 'ru',
        public bool $test = false,
        public bool $webView = false,
        public string $shieldPosition = 'bottom-right',
        public bool $hideShield = false,
    ){}

    public function render(): View
    {
        return view('dsoloview::extended-yandex-captcha');
    }
}
