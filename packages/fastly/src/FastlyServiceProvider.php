<?php

namespace OpenCompany\Integrations\Fastly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Fastly integration with Laravel's service container.
 *
 * Binds FastlyService from host credentials and registers the Fastly tool
 * provider with the shared registry when available.
 */
class FastlyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FastlyService::class, function ($app): FastlyService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new FastlyService(apiToken: $creds?->get('fastly', 'api_token', '') ?? '', apiUrl: $creds?->get('fastly', 'api_url', 'https://api.fastly.com') ?? 'https://api.fastly.com', rtUrl: $creds?->get('fastly', 'rt_url', 'https://rt.fastly.com') ?? 'https://rt.fastly.com');
        });
    }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new FastlyToolProvider); }
}