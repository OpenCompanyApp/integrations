<?php

namespace OpenCompany\Integrations\OpenAlex;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the OpenAlex integration with Laravel's service container.
 *
 * Binds OpenAlexService using host credentials and registers the provider with
 * the shared ToolProviderRegistry during boot.
 */
class OpenAlexServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenAlexService::class, function ($app): OpenAlexService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new OpenAlexService(
                apiKey: $creds?->get('openalex', 'api_key', '') ?? '',
                baseUrl: $creds?->get('openalex', 'url', 'https://api.openalex.org') ?? 'https://api.openalex.org',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OpenAlexToolProvider);
        }
    }
}
