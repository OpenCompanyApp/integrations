<?php

namespace OpenCompany\Integrations\Brex;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Brex integration with Laravel's service container.
 *
 * Binds BrexService from host credentials and registers BrexToolProvider with
 * the shared provider registry when available.
 */
class BrexServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BrexService::class, function ($app): BrexService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new BrexService(accessToken: $creds?->get('brex', 'access_token', '') ?? '', baseUrl: $creds?->get('brex', 'url', 'https://api.brex.com') ?? 'https://api.brex.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new BrexToolProvider);
    }
}