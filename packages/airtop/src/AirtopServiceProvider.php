<?php

namespace OpenCompany\Integrations\Airtop;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AirtopServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AirtopService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AirtopService(
                apiKey: $creds->get('airtop', 'api_key', ''),
                baseUrl: $creds->get('airtop', 'url', 'https://app.airtop.ai/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AirtopToolProvider());
        }
    }
}
