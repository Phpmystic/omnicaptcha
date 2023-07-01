<?php

namespace Phpmystic\OmniCaptcha\Tests\Unit;

use GuzzleHttp\Handler\MockHandler;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Config;
use Phpmystic\OmniCaptcha\Services\ReCaptcha\CaptchaService as ReCaptchaService;
use Phpmystic\OmniCaptcha\Services\Hcaptcha\CaptchaService as HcaptchaService;
use Phpmystic\OmniCaptcha\Services\ServiceLocator;
use Phpmystic\OmniCaptcha\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class CaptchaTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_recaptcha_can_return_proper_response()
    {
        Config::set('omnicaptcha.captcha', 'recaptcha');
        /** @var Repository $configRepository */
        $configRepository = $this->app->make(Repository::class);

        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'success' => true
            ]))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $httpClient = new Client(['handler' => $handlerStack]);

        $recaptchaService = new ReCaptchaService(
            $configRepository,
            $httpClient
        );

        $this->assertTrue($recaptchaService->verify('soekezokzeozke'));
    }

    public function test_it_hcaptcha_can_return_proper_response()
    {
        Config::set('omnicaptcha.captcha', 'hcaptcha');
        /** @var Repository $configRepository */
        $configRepository = $this->app->make(Repository::class);

        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'success' => true
            ]))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $httpClient = new Client(['handler' => $handlerStack]);

        $hCaptchaService = new HcaptchaService(
            $configRepository,
            $httpClient
        );

        $this->assertTrue($hCaptchaService->verify('soekezokzeozke'));
    }
}
