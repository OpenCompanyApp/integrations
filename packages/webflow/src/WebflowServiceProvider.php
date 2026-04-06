<?php

namespace OpenCompany\Integrations\Webflow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WebflowServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WebflowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WebflowService(
                accessToken: $creds->get('webflow', 'access_token', ''),
                baseUrl: $creds->get('webflow', 'url', 'https://api.webflow.com'),
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
