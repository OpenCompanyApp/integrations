<?php

namespace OpenCompany\Integrations\Cerebras;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Cerebras integration with Laravel's service container.
 *
 * Binds CerebrasService from configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry when available.
 */
class CerebrasServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CerebrasService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CerebrasService(
                apiKey: $creds->get('cerebras', 'api_key', ''),
                baseUrl: $creds->get('cerebras', 'base_url', 'https://api.cerebras.ai'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CerebrasToolProvider());
        }
    }
}
