<?php

namespace OpenCompany\Integrations\N8n;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the n8n integration with Laravel's service container.
 *
 * Binds the N8nService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class N8nServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(N8nService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new N8nService(
                apiKey: $creds->get('n8n', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new N8nToolProvider());
        }
    }
}
