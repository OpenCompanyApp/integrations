<?php

namespace OpenCompany\Integrations\Firecrawl;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Firecrawl integration.
 *
 * Registers the FirecrawlService as a singleton (resolving credentials
 * from the CredentialResolver) and boots the tool provider into the
 * ToolProviderRegistry when available.
 */
class FirecrawlServiceProvider extends ServiceProvider
{
    /**
     * Register the FirecrawlService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(FirecrawlService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FirecrawlService(
                apiKey: $creds->get('firecrawl', 'api_key', ''),
                baseUrl: $creds->get('firecrawl', 'url', 'https://api.firecrawl.dev/v1'),
            );
        });
    }

    /**
     * Boot the tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FirecrawlToolProvider());
        }
    }
}
