<?php

namespace OpenCompany\Integrations\Splunk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SplunkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SplunkService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SplunkService(
                accessToken: $creds->get('splunk', 'access_token', ''),
                baseUrl: $creds->get('splunk', 'url', 'https://localhost:8089/services'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SplunkToolProvider());
        }
    }
}
