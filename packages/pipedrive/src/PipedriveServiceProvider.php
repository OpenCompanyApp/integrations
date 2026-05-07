<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Pipedrive integration with Laravel's service container.
 *
 * Binds the Pipedrive API client from host credentials and adds the generated
 * tool provider to the shared integration registry when available.
 */
class PipedriveServiceProvider extends ServiceProvider
{
    /**
     * Register the Pipedrive API service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(PipedriveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PipedriveService(
                apiToken: $creds->get('pipedrive', 'api_token', ''),
                baseUrl: $creds->get('pipedrive', 'base_url', 'https://api.pipedrive.com'),
            );
        });
    }

    /**
     * Register Pipedrive tools with the shared registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new PipedriveToolProvider());
        }
    }
}
