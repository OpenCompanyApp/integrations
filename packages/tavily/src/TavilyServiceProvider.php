<?php

namespace OpenCompany\Integrations\Tavily;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Tavily integration with Laravel's service container.
 *
 * Binds TavilyService from configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry when the host exposes it.
 */
class TavilyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TavilyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TavilyService(
                apiKey: $creds->get('tavily', 'api_key', ''),
                baseUrl: $creds->get('tavily', 'url', 'https://api.tavily.com'),
                projectId: $creds->get('tavily', 'project_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TavilyToolProvider());
        }
    }
}
