<?php

namespace OpenCompany\Integrations\Freshdesk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Freshdesk integration.
 *
 * Registers the FreshdeskService singleton and bootstraps the tool provider
 * into the platform's ToolProviderRegistry.
 */
class FreshdeskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FreshdeskService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FreshdeskService(
                apiKey: $creds->get('freshdesk', 'api_key', ''),
                domain: $creds->get('freshdesk', 'domain', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshdeskToolProvider());
        }
    }
}
