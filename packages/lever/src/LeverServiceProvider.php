<?php

namespace OpenCompany\Integrations\Lever;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Lever integration with Laravel's service container.
 *
 * Binds LeverService using host credentials and registers LeverToolProvider
 * with the shared integration registry during boot.
 */
class LeverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LeverService::class, function ($app): LeverService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new LeverService(
                apiKey: $creds?->get('lever', 'api_key', '') ?? '',
                baseUrl: $creds?->get('lever', 'url', 'https://api.lever.co/v0/postings') ?? 'https://api.lever.co/v0/postings',
                dataBaseUrl: $creds?->get('lever', 'data_url', 'https://api.lever.co/v1') ?? 'https://api.lever.co/v1',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new LeverToolProvider);
        }
    }
}
