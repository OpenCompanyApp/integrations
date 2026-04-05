<?php

namespace OpenCompany\Integrations\FreeAgent;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FreeAgentServiceProvider extends ServiceProvider
{
    /**
     * Register the FreeAgent service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(FreeAgentService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FreeAgentService(
                accessToken: $creds->get('freeagent', 'access_token', ''),
                baseUrl: $creds->get('freeagent', 'url', 'https://api.freeagent.com/v2'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreeAgentToolProvider());
        }
    }
}
