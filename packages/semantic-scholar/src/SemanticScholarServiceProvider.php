<?php

namespace OpenCompany\Integrations\SemanticScholar;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Semantic Scholar integration with Laravel's service container.
 *
 * Binds SemanticScholarService using host credentials and registers the tool
 * provider with the shared registry during boot.
 */
class SemanticScholarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SemanticScholarService::class, function ($app): SemanticScholarService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new SemanticScholarService(apiKey: $creds?->get('semantic-scholar', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new SemanticScholarToolProvider);
        }
    }
}
