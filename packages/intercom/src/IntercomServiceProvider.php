<?php

namespace OpenCompany\Integrations\Intercom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the IntercomService singleton and bootstraps Intercom tools.
 */
class IntercomServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IntercomService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new IntercomService(
                accessToken: $creds->get('intercom', 'access_token', ''),
                baseUrl: $creds->get('intercom', 'base_url', 'https://api.intercom.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new IntercomToolProvider());
        }
    }
}
