<?php

namespace OpenCompany\Integrations\HelpScout;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HelpScoutServiceProvider extends ServiceProvider
{
    /**
     * Register the HelpScout service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(HelpScoutService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HelpScoutService(
                accessToken: $creds->get('helpscout', 'access_token', ''),
                baseUrl: $creds->get('helpscout', 'url', 'https://api.helpscout.net/v2'),
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
                ->register(new HelpScoutToolProvider());
        }
    }
}
