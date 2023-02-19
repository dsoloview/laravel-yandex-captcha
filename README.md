
### Laravel Yandex Captcha

A small package that will allow you to use Yandex SmartCaptcha in your Laravel app

## Features

- Easy to use Yandex SmartCaptcha Blade component
- Easy to use Yandex SmartCaptcha validation

## Installation

Install dsoloview/laravel-yandex-captcha from composer

```bash
  composer require dsoloview/laravel-yandex-captcha
```

## Usage

1. Add to your .env
   `YANDEX_CAPTCHA_CLIENT_KEY`
   `YANDEX_CAPTCHA_SERVER_KEY`

2. Publish config
 ```bash
 php artisan vendor:publish --tag=yandex-captcha-config
 ```
3. Add the Blade component to the form that needs a captcha
 ```html
 <form action="{{route('login')}}" method="post">  
  @csrf  
  <input type="text" name="email">  
 <input type="password" name="password">  
 <x-yandex-captcha></x-yandex-captcha>  
 <button type="submit">Send</button>
</form>
 ```
4. Add YandexCaptcha validation rule
```php
<?php  
  
namespace App\Http\Requests;  
  
use Dsoloview\YandexCaptcha\Rules\YandexCaptcha;  
use Illuminate\Foundation\Http\FormRequest;  
  
class LoginRequest extends FormRequest  
{  
  public function rules(): array  
{  
  return [  
  'email' => ['required', 'email'],  
  'password' => ['required', 'string', 'min:8'],  
  'smart-token' => ['required', new YandexCaptcha]  
  ];  
}
  
  public function authorize(): bool  
  {  
  return true;  
  }  
}
```

If you want to customize blade component you can publish it with
 ```bash
 php artisan vendor:publish --tag=yandex-captcha-view
 ```

