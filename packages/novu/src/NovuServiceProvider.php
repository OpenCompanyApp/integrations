<?php

namespace OpenCompany\Integrations\Novu;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class NovuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NovuService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NovuService(
                apiKey: $creds->get('novu', 'api_key', ''),
                baseUrl: $creds->get('novu', 'url', 'https://api.novu.co'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new NovuToolProvider());
        }
    }
}
