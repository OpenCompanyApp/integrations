<?php

namespace OpenCompany\Integrations\BraveSearch;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Brave Search integration with Laravel's service container.
 *
 * Binds BraveSearchService using host credentials and registers the provider
 * with the ToolProviderRegistry during boot.
 */
class BraveSearchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BraveSearchService::class, function ($app): BraveSearchService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new BraveSearchService(apiKey: $creds?->get('brave-search', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new BraveSearchToolProvider);
        }
    }
}
