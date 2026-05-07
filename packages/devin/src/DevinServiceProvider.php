<?php

namespace OpenCompany\Integrations\Devin;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Devin integration with Laravel's service container.
 *
 * Binds the Devin API client and registers the tool provider when the host
 * application exposes the integration registry.
 */
class DevinServiceProvider extends ServiceProvider
{
    /**
     * Register the Devin API service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(DevinService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DevinService(
                apiKey: $creds->get('devin', 'api_key', ''),
                baseUrl: $creds->get('devin', 'url', 'https://api.devin.ai'),
                orgId: $creds->get('devin', 'org_id', ''),
                apiVersion: $creds->get('devin', 'api_version', 'v3'),
            );
        });
    }

    /**
     * Register the Devin tool provider with the shared registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DevinToolProvider());
        }
    }
}
