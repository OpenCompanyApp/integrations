<?php

namespace OpenCompany\Integrations\Fellow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FellowServiceProvider extends ServiceProvider
{
    /**
     * Register the FellowService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(FellowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FellowService(
                accessToken: $creds->get('fellow', 'access_token', ''),
                baseUrl: $creds->get('fellow', 'url', 'https://api.fellow.app/v2'),
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
                ->register(new FellowToolProvider());
        }
    }
}
