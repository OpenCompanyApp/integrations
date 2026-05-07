<?php

namespace OpenCompany\Integrations\Browserless;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Browserless integration with Laravel's service container.
 *
 * Binds BrowserlessService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class BrowserlessServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BrowserlessService::class, function ($app): BrowserlessService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new BrowserlessService(apiKey: $creds?->get('browserless', 'api_key', '') ?? '', baseUrl: $creds?->get('browserless', 'url', 'https://production-sfo.browserless.io') ?? 'https://production-sfo.browserless.io');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new BrowserlessToolProvider); }
    }
}
