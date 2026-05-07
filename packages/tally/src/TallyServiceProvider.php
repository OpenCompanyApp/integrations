<?php

namespace OpenCompany\Integrations\Tally;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Tally forms integration.
 *
 * Registers the TallyService singleton with resolved credentials
 * and boots the TallyToolProvider into the ToolProviderRegistry.
 */
class TallyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TallyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TallyService(
                accessToken: $creds->get('tally', 'access_token', ''),
                baseUrl: $creds->get('tally', 'url', 'https://api.tally.so'),
                apiVersion: $creds->get('tally', 'api_version', '2026-02-05'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TallyToolProvider());
        }
    }
}
