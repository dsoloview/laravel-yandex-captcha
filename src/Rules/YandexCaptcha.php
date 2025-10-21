<?php

namespace Dsoloview\YandexCaptcha\Rules;

use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YandexCaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $response = Http::get(
                'https://smartcaptcha.yandexcloud.net/validate',
                [
                    'secret' => config('yandex_captcha.server_key'),
                    'token' => $value,
                    'ip' => request()->ip(),
                ],
            );
        } catch (Exception $e) {
            Log::error(
                "Unknown error occured during checking Yandex SmartCaptcha: {$e->getMessage()}",
                [
                    'method' => __METHOD__,
                    'exception' => $e,
                ],
            );

            return;
        }

        if ($response->status() !== 200) {
            $fail('Error with Yandex SmartCaptcha validation');
        }

        $body = json_decode($response->body(), true);

        if ($body['status'] !== 'ok') {
            $fail('Error with Yandex SmartCaptcha validation');
        }
    }
}
