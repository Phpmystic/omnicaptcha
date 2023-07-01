<?php

namespace Phpmystic\OmniCaptcha\Services;

use InvalidArgumentException;

class ServiceLocator
{
    /**
     * @var array<string, CaptchaServiceContract>
     */
    private array $servicesMap = [];

    public function getInstance(string $provider): CaptchaServiceContract
    {
        if (!isset($this->servicesMap[$provider])) {
            throw new InvalidArgumentException("provided provider doesn't have an implementation");
        }

        return $this->servicesMap[$provider];
    }

    public function registerProvider(string $provider, CaptchaServiceContract $captchaService)
    {
        $this->servicesMap[$provider] = $captchaService;
    }
}
