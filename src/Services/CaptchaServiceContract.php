<?php

namespace Phpmystic\OmniCaptcha\Services;

interface CaptchaServiceContract
{
    public function verify(string $token): bool;

    public function extractTokenFromArray(array $attributes): string;
}
