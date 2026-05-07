<?php

namespace OpenCompany\Integrations\Logto;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Logto integration with Laravel's service container.
 *
 * Binds LogtoService from host credentials and registers the tool provider
 * with the shared registry when the host exposes one.
 */
class LogtoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LogtoService::class, function ($app): LogtoService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new LogtoService(
                clientId: $creds?->get('logto', 'client_id', '') ?? '',
                clientSecret: $creds?->get('logto', 'client_secret', '') ?? '',
                accessToken: $creds?->get('logto', 'access_token', '') ?? '',
                baseUrl: $creds?->get('logto', 'base_url', 'https://tenant.logto.app') ?? 'https://tenant.logto.app',
                tokenUrl: $creds?->get('logto', 'token_url', '') ?? '',
                resource: $creds?->get('logto', 'resource', '') ?? '',
                scope: $creds?->get('logto', 'scope', 'all') ?? 'all',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new LogtoToolProvider);
        }
    }
}