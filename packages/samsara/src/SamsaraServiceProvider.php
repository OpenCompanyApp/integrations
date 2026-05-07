<?php

namespace OpenCompany\Integrations\Samsara;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Samsara integration with Laravel's service container.
 */
class SamsaraServiceProvider extends ServiceProvider
{
    /**
     * Register the Samsara service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(SamsaraService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SamsaraService(
                accessToken: $creds->get('samsara', 'access_token', ''),
                baseUrl: $creds->get('samsara', 'url', 'https://api.samsara.com'),
            );
        });
    }

    /**
     * Boot the Samsara service provider and register with the tool provider registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SamsaraToolProvider());
        }
    }
}
