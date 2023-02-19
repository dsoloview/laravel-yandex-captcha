<?php

namespace Dsoloview\YandexCaptcha\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Http;

class YandexCaptcha implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        $args = http_build_query([
            'secret' => config('yandex_captcha.server_key'),
            'token' => $value,
            'ip' => request()->ip(),
        ]);

        $response = Http::get('https://captcha-api.yandex.ru/validate', $args);

        if ($response->status() !== 200) {
            $fail('Error with Yandex SmartCaptcha validation');
        }

        $body = json_decode($response->body(), true);

        if ($body['status'] !== 'ok') {
            $fail('Error with Yandex SmartCaptcha validation');
        }
    }
}
