<?php

namespace OpenCompany\Integrations\Bitrise;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Bitrise integration with Laravel.
 *
 * Binds the Bitrise API client from host credentials and registers the tool
 * provider when the shared registry is available.
 */
class BitriseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BitriseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BitriseService(
                apiToken: $creds->get('bitrise', 'api_token', ''),
                baseUrl: $creds->get('bitrise', 'url', 'https://api.bitrise.io/v0.1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new BitriseToolProvider());
        }
    }
}
