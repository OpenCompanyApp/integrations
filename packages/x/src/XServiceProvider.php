<?php

namespace OpenCompany\Integrations\X;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Twitter/X integration.
 *
 * Registers the {@see XService} as a singleton using credentials
 * from the {@see CredentialResolver}, and boots the {@see XToolProvider}
 * into the {@see ToolProviderRegistry} when available.
 */
class XServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(XService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new XService(
                accessToken: $creds->get('x', 'access_token', ''),
                baseUrl: $creds->get('x', 'base_url', 'https://api.twitter.com/2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new XToolProvider());
        }
    }
}
