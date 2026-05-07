<?php

namespace OpenCompany\Integrations\Statuspage;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Atlassian Statuspage integration with Laravel.
 *
 * Binds the Statuspage API client and adds the tool provider to the discovery registry.
 */
class StatuspageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(StatuspageService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new StatuspageService(
                apiKey: $creds->get('statuspage', 'api_key', ''),
                pageId: $creds->get('statuspage', 'page_id', ''),
                baseUrl: $creds->get('statuspage', 'url', 'https://api.statuspage.io/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new StatuspageToolProvider());
        }
    }
}
