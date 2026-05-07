<?php

namespace OpenCompany\Integrations\Keycloak;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Keycloak integration with Laravel's service container.
 *
 * Binds KeycloakService from host credentials and registers the tool provider
 * with the shared registry when the host exposes one.
 */
class KeycloakServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KeycloakService::class, function ($app): KeycloakService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new KeycloakService(
                accessToken: $creds?->get('keycloak', 'access_token', '') ?? '',
                baseUrl: $creds?->get('keycloak', 'base_url', 'https://keycloak.example.test') ?? 'https://keycloak.example.test',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new KeycloakToolProvider);
        }
    }
}