<?php

namespace OpenCompany\Integrations\Neon;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Neon integration with Laravel's service container.
 *
 * Binds the Neon API client using host-provided credentials and registers
 * the Neon tool provider with the shared registry when available.
 */
class NeonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NeonService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NeonService(
                accessToken: (string) $creds->get('neon', 'access_token', ''),
                baseUrl: (string) $creds->get('neon', 'url', 'https://console.neon.tech/api/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new NeonToolProvider);
        }
    }
}