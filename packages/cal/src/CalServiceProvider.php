<?php

namespace OpenCompany\Integrations\Cal;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Cal.com integration.
 *
 * Registers the CalService singleton and bootstraps the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class CalServiceProvider extends ServiceProvider
{
    /**
     * Register the CalService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(CalService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $accessToken = (string) $creds->get('cal', 'access_token', '');
            $baseUrl = (string) $creds->get('cal', 'url', '');

            if ($accessToken === '') {
                $accessToken = (string) $creds->get('cal-com', 'access_token', '');
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('cal-com', 'url', 'https://api.cal.com/v2');
            }

            return new CalService(
                accessToken: $accessToken,
                baseUrl: $baseUrl,
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
                ->register(new CalToolProvider());
        }
    }
}
