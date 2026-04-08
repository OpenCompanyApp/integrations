<?php

namespace OpenCompany\Integrations\CalCom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Cal.com v2 integration.
 *
 * Registers the CalComService singleton and bootstraps the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class CalComServiceProvider extends ServiceProvider
{
    /**
     * Register the CalComService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(CalComService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CalComService(
                accessToken: $creds->get('cal-com', 'access_token', ''),
                baseUrl: $creds->get('cal-com', 'url', 'https://api.cal.com/v2'),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CalComToolProvider());
        }
    }
}
