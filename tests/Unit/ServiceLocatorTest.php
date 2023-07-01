<?php

namespace Phpmystic\OmniCaptcha\Tests\Unit;

use Illuminate\Support\Facades\Config;
use Phpmystic\OmniCaptcha\Services\ReCaptcha\CaptchaService as ReCaptchaService;
use Phpmystic\OmniCaptcha\Services\Hcaptcha\CaptchaService as HcaptchaService;
use Phpmystic\OmniCaptcha\Services\ServiceLocator;
use Phpmystic\OmniCaptcha\Tests\TestCase;

class ServiceLocatorTest extends TestCase
{
    private ServiceLocator $serviceLocator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->serviceLocator = $this->app->make(ServiceLocator::class);
    }

    public function test_can_get_recaptcha_service()
    {
        Config::set('omnicaptcha.captcha', 'recaptcha');

        $provider = config('omnicaptcha.captcha');
        $captchaService = $this->serviceLocator->getInstance($provider);

        $this->assertInstanceOf(ReCaptchaService::class, $captchaService);
    }

    public function test_can_get_hcaptcha_service()
    {
        Config::set('omnicaptcha.captcha', 'hcaptcha');

        $provider = config('omnicaptcha.captcha');
        $captchaService = $this->serviceLocator->getInstance($provider);

        $this->assertInstanceOf(HcaptchaService::class, $captchaService);
    }
}
