<?php

namespace OpenCompany\Integrations\HealthchecksIo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Healthchecks.io integration with Laravel's service container.
 *
 * Binds HealthchecksIoService from host credentials and registers the tool
 * provider with the discovery registry when available.
 */
class HealthchecksIoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HealthchecksIoService::class, function ($app): HealthchecksIoService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new HealthchecksIoService(
                apiKey: $creds?->get('healthchecks-io', 'api_key', '') ?? '',
                baseUrl: $creds?->get('healthchecks-io', 'url', 'https://healthchecks.io/api/v3') ?? 'https://healthchecks.io/api/v3',
                pingBaseUrl: $creds?->get('healthchecks-io', 'ping_url', 'https://hc-ping.com') ?? 'https://hc-ping.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new HealthchecksIoToolProvider);
        }
    }
}
