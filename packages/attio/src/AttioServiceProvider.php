<?php

namespace OpenCompany\Integrations\Attio;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Attio integration with Laravel's service container.
 *
 * Binds AttioService from stored credentials and registers AttioToolProvider
 * with the shared tool registry when available.
 */
class AttioServiceProvider extends ServiceProvider
{
    /**
     * Register the Attio service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(AttioService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AttioService(
                accessToken: $creds->get('attio', 'access_token', ''),
                baseUrl: $creds->get('attio', 'base_url', 'https://api.attio.com'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AttioToolProvider());
        }
    }
}
