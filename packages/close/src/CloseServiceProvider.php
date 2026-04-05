<?php

namespace OpenCompany\Integrations\Close;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Close CRM integration.
 *
 * Registers the CloseService singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available.
 */
class CloseServiceProvider extends ServiceProvider
{
    /**
     * Register the CloseService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(CloseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CloseService(
                apiKey: $creds->get('close', 'api_key', ''),
                baseUrl: $creds->get('close', 'url', 'https://api.close.com/api/v1'),
            );
        });
    }

    /**
     * Boot the service provider — register tools with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CloseToolProvider());
        }
    }
}
