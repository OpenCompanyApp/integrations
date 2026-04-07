<?php

namespace OpenCompany\Integrations\Recaptcha;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RecaptchaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RecaptchaService::class, function ($app) {
            $baseUrl = config('services.recaptcha.url', 'https://recaptchaenterprise.googleapis.com/v1');

            return new RecaptchaService(baseUrl: $baseUrl);
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RecaptchaToolProvider());
        }
    }
}
