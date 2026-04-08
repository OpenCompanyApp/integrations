<?php

namespace OpenCompany\Integrations\NocoDB;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the NocoDB integration.
 *
 * Registers the NocoDBService singleton and bootstraps the NocoDB tool provider.
 */
class NocoDBServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NocoDBService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NocoDBService(
                apiToken: $creds->get('nocodb', 'api_token', ''),
                baseUrl: $creds->get('nocodb', 'base_url', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new NocoDBToolProvider());
        }
    }
}
