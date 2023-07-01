<?php

namespace Phpmystic\OmniCaptcha\Services\HCaptcha;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Illuminate\Support\Arr;
use Phpmystic\OmniCaptcha\Services\CaptchaServiceContract;

class CaptchaService implements CaptchaServiceContract
{
    private const VERIFY_ENDPOINT = 'https://hcaptcha.com/siteverify';

    public function __construct(
        private Repository $configRepository,
        private Client $httpClient
    )
    {}

    public function verify(string $token): bool
    {
        $secretKey = $this->configRepository->get('omnicaptcha.providers.hcaptcha.secret_key');

        $response = $this->httpClient->post(self::VERIFY_ENDPOINT, [
            'form_params' => [
                'secret'   => $secretKey,
                'response' => $token,
            ]
        ]);

        $responseObject = json_decode($response->getBody()->getContents());

        return $responseObject->success;
    }

    public function extractTokenFromArray(array $attributes): string
    {
        return (string)Arr::get($attributes, 'h-captcha-response');
    }
}
