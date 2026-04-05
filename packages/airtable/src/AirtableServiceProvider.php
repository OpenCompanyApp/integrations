<?php

namespace OpenCompany\Integrations\Airtable;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Airtable integration.
 *
 * Registers the AirtableService singleton and bootstraps the Airtable tool provider.
 */
class AirtableServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AirtableService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AirtableService(
                accessToken: $creds->get('airtable', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AirtableToolProvider());
        }
    }
}
