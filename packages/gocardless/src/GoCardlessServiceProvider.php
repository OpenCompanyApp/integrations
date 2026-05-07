<?php

namespace OpenCompany\Integrations\GoCardless;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the GoCardless integration with Laravel's service container.
 *
 * Binds GoCardlessService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class GoCardlessServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoCardlessService::class, function ($app): GoCardlessService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new GoCardlessService(
                apiKey: $creds?->get('gocardless', 'api_key', '') ?? '',
                baseUrl: $creds?->get('gocardless', 'url', 'https://api.gocardless.com') ?? 'https://api.gocardless.com',
                apiVersion: $creds?->get('gocardless', 'api_version', '2015-07-06') ?? '2015-07-06',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new GoCardlessToolProvider);
        }
    }
}
