<?php

namespace OpenCompany\Integrations\Wealthbox;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WealthboxServiceProvider extends ServiceProvider
{
    /**
     * Register the Wealthbox service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(WealthboxService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WealthboxService(
                accessToken: $creds->get('wealthbox', 'access_token', ''),
                baseUrl: $creds->get('wealthbox', 'url', 'https://api.crmworkspace.com/v1'),
            );
        });
    }

    /**
     * Boot the Wealthbox service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WealthboxToolProvider());
        }
    }
}
