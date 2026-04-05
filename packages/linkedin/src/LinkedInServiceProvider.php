<?php

namespace OpenCompany\Integrations\LinkedIn;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the LinkedIn integration.
 *
 * Registers the LinkedInService singleton with credentials resolved from
 * the CredentialResolver, and boots the tool provider into the registry.
 */
class LinkedInServiceProvider extends ServiceProvider
{
    /**
     * Register the LinkedIn service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(LinkedInService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LinkedInService(
                accessToken: $creds->get('linkedin', 'access_token', ''),
                baseUrl: $creds->get('linkedin', 'url', 'https://api.linkedin.com/v2'),
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
                ->register(new LinkedInToolProvider());
        }
    }
}
