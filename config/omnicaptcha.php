<?php

return [
    "captcha"   => "recaptcha",
    "providers" => [
        "recaptcha" => [
            "secret_key" => env('RECAPTCHA_SECRET_KEY', ''),
            "site_key"   => env('RECAPTCHA_SITE_KEY', '')
        ],
        "hcaptcha" => [
            "secret_key" => env('HCAPTCHA_SECRET_KEY', ''),
            "site_key"   => env('HCAPTCHA_SITE_KEY', ''),
        ],
        "cloudflare" => [
            "secret_key" => env('CLOUDFLARE_SECRET_KEY', ''),
            "site_key"   => env('CLOUDFLARE_SITE_KEY', '')
        ],
    ]
];
