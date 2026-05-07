<?php

namespace OpenCompany\Integrations\Browserbase;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Browserbase integration with Laravel's service container.
 *
 * Binds BrowserbaseService using host credentials and registers the provider
 * for catalog discovery when the registry exists.
 */
class BrowserbaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BrowserbaseService::class, function ($app): BrowserbaseService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new BrowserbaseService(apiKey: $creds?->get('browserbase', 'api_key', '') ?? '', baseUrl: $creds?->get('browserbase', 'url', 'https://api.browserbase.com') ?? 'https://api.browserbase.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new BrowserbaseToolProvider); }
    }
}
