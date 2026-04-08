<?php

namespace OpenCompany\Integrations\Clockify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Clockify integration.
 *
 * Registers the ClockifyService singleton and bootstraps the tool provider
 * into the ToolProviderRegistry.
 */
class ClockifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ClockifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ClockifyService(
                apiKey: $creds->get('clockify', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ClockifyToolProvider());
        }
    }
}
