<?php

namespace OpenCompany\Integrations\FusionAuth;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the FusionAuth integration with Laravel's service container.
 *
 * Binds FusionAuthService from host credentials and registers the tool provider
 * with the shared registry when the host exposes one.
 */
class FusionAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FusionAuthService::class, function ($app): FusionAuthService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new FusionAuthService(
                apiKey: $creds?->get('fusionauth', 'api_key', '') ?? '',
                baseUrl: $creds?->get('fusionauth', 'base_url', 'https://fusionauth.example.test') ?? 'https://fusionauth.example.test',
                tenantId: $creds?->get('fusionauth', 'tenant_id', '') ?? '',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new FusionAuthToolProvider);
        }
    }
}
