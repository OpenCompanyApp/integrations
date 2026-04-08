<?php

namespace OpenCompany\Integrations\Notion;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the NotionService singleton and bootstraps Notion tools.
 */
class NotionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NotionService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NotionService(
                apiKey: $creds->get('notion', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new NotionToolProvider());
        }
    }
}
