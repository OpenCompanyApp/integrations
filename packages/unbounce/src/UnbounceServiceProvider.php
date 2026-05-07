<?php

namespace OpenCompany\Integrations\Unbounce;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Unbounce integration with Laravel's service container.
 *
 * Binds the Unbounce API client and registers the tool provider when the shared
 * registry is available.
 */
class UnbounceServiceProvider extends ServiceProvider
{
    /**
     * Register the Unbounce service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(UnbounceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new UnbounceService(
                accessToken: $creds->get('unbounce', 'access_token', ''),
                baseUrl: $creds->get('unbounce', 'url', 'https://api.unbounce.com'),
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
                ->register(new UnbounceToolProvider());
        }
    }
}
