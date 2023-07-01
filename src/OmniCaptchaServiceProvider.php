<?php

namespace Phpmystic\OmniCaptcha;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Config\Repository as ConfigRepository;
use Phpmystic\OmniCaptcha\Services\CaptchaServiceContract;
use Phpmystic\OmniCaptcha\Services\HCaptcha\CaptchaService as HCaptchaService;
use Phpmystic\OmniCaptcha\Services\ReCaptcha\CaptchaService as ReCaptchaService;
use Phpmystic\OmniCaptcha\Services\CloudFlare\CaptchaService as CloudFlareCaptchaService;
use Phpmystic\OmniCaptcha\Services\ServiceLocator;
use Phpmystic\OmniCaptcha\Facades\OmniCaptcha as OmniCaptchaFacade;

class OmniCaptchaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPublishing();
        $this->addValidationRules();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/omnicaptcha.php', 'omnicaptcha'
        );

        $this->app->singleton(ServiceLocator::class, function (Application $app) {
            $serviceLocator = new ServiceLocator();
            /** @var CaptchaServiceContract $reCaptchaService */
            $reCaptchaService = $app->make(ReCaptchaService::class);
            /** @var CaptchaServiceContract $reCaptchaService */
            $hCaptchaService = $app->make(HCaptchaService::class);
            /** @var CaptchaServiceContract $reCaptchaService */
            $cloudFlareCaptcha = $app->make(CloudFlareCaptchaService::class);

            $serviceLocator->registerProvider(
                'hcaptcha',
                $hCaptchaService
            );

            $serviceLocator->registerProvider(
                'recaptcha',
                $reCaptchaService
            );

            $serviceLocator->registerProvider(
                'cloudflare',
                $cloudFlareCaptcha
            );

            return $serviceLocator;
        });

        $this->app->singleton(OmniCaptcha::class, function (Application $app) {
            $configRepository = $app->make(ConfigRepository::class);
            $serviceLocator = $app->make(ServiceLocator::class);

            return new OmniCaptcha(
                $serviceLocator,
                $configRepository
            );
        });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/omnicaptcha.php' => config_path('omnicaptcha.php'),
        ], 'omnicaptcha');
    }

    private function addValidationRules()
    {
        Validator::extendImplicit('omnicaptcha', function($attribute, $value, $parameters, $validator) {
            return OmniCaptchaFacade::verify($value);
        });
    }
}