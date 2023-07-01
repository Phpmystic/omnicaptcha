<?php


namespace Phpmystic\OmniCaptcha\Tests;


use Phpmystic\OmniCaptcha\OmniCaptchaServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            OmniCaptchaServiceProvider::class,
        ];
    }
}
