<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Pipedrive CRM integration.
 *
 * Registers the PipedriveService singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available.
 */
class PipedriveServiceProvider extends ServiceProvider
{
    /**
     * Register the PipedriveService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(PipedriveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PipedriveService(
                apiToken: $creds->get('pipedrive', 'api_token', ''),
                baseUrl: $creds->get('pipedrive', 'url', 'https://api.pipedrive.com/v1'),
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
                ->register(new PipedriveToolProvider());
        }
    }
}
