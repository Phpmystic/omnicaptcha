<?php

namespace Phpmystic\OmniCaptcha;

use Illuminate\Config\Repository as ConfigRepository;
use Phpmystic\OmniCaptcha\Services\ServiceLocator;
use Illuminate\Http\Request;


class OmniCaptcha
{
    public function __construct(
        private ServiceLocator $serviceLocator,
        private ConfigRepository $configRepository
    )
    {
    }

    public function verify(string $token): bool
    {
        $provider = (string)$this->configRepository->get('omnicaptcha.captcha');
        $captchaService = $this->serviceLocator->getInstance($provider);

        return $captchaService->verify($token);
    }

    public function verifyIlluminateRequest(Request $request): bool
    {
        $provider = (string)$this->configRepository->get('omnicaptcha.captcha');
        $captchaService = $this->serviceLocator->getInstance($provider);
        $token = $captchaService->extractTokenFromArray($request->all());

        return $captchaService->verify($token);
    }
}