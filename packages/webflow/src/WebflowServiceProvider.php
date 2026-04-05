<?php

namespace OpenCompany\Integrations\Webflow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the WebflowService singleton and bootstraps Webflow tools.
 */
class WebflowServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WebflowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WebflowService(
                apiKey: $creds->get('webflow', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WebflowToolProvider());
        }
    }
}
