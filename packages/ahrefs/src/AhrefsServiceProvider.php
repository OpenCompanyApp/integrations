<?php

namespace OpenCompany\Integrations\Ahrefs;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Ahrefs integration with Laravel's service container.
 *
 * Binds AhrefsService with credentials from CredentialResolver and registers
 * the AhrefsToolProvider when the shared registry is available.
 */
class AhrefsServiceProvider extends ServiceProvider
{
    /**
     * Register the Ahrefs service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AhrefsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AhrefsService(
                apiKey: $creds->get('ahrefs', 'api_key', ''),
                baseUrl: $creds->get('ahrefs', 'url', 'https://api.ahrefs.com'),
            );
        });
    }

    /**
     * Boot the provider and register Ahrefs tools.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AhrefsToolProvider());
        }
    }
}
