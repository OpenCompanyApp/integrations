<?php

namespace OpenCompany\Integrations\Greenhouse;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Greenhouse integration with Laravel's service container.
 *
 * Binds GreenhouseService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class GreenhouseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GreenhouseService::class, function ($app): GreenhouseService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new GreenhouseService(
                accessToken: $creds?->get('greenhouse', 'access_token', '') ?? '',
                clientId: $creds?->get('greenhouse', 'client_id', '') ?? '',
                clientSecret: $creds?->get('greenhouse', 'client_secret', '') ?? '',
                baseUrl: $creds?->get('greenhouse', 'url', 'https://harvest.greenhouse.io') ?? 'https://harvest.greenhouse.io',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new GreenhouseToolProvider);
        }
    }
}
