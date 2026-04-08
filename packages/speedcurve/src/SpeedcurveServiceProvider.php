<?php

namespace OpenCompany\Integrations\Speedcurve;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SpeedcurveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SpeedcurveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SpeedcurveService(
                apiKey: $creds->get('speedcurve', 'api_key', ''),
                baseUrl: $creds->get('speedcurve', 'url', 'https://api.speedcurve.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SpeedcurveToolProvider());
        }
    }
}
