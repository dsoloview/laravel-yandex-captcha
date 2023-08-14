<script
        src="https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=smartCaptchaInit"
        defer
></script>
<div id="extended-captcha-container" class="extended-captcha-container"></div>

<script>
    function callback() {
        @if($invisible)
            document.querySelector('form[data-invisible-captcha]').submit();
        @endif
    }
    function smartCaptchaInit() {
        if (!window.smartCaptcha) {
            return;
        }

        window.smartCaptcha.render('extended-captcha-container', {
            callback: callback,
            sitekey: @json(config('yandex_captcha.client_key')),
            invisible: @json($invisible),
            test: @json($test),
            webview: @json($webView),
            shieldPosition: @json($shieldPosition),
            hideShield: @json($hideShield)
        });

        @if($invisible)
            const form = document.querySelector('form[data-invisible-captcha]');

            if (!form) {
                console.error('Form with data-invisible-captcha attribute not found');
                return;
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                window.smartCaptcha.execute();
            });
        @endif


    }
</script>
