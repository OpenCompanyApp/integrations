<?php

namespace OpenCompany\Integrations\Lemlist;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Lemlist integration.
 *
 * Registers the LemlistService singleton and auto-discovers the tool provider
 * with the ToolProviderRegistry when integration-core is available.
 */
class LemlistServiceProvider extends ServiceProvider
{
    /**
     * Register the LemlistService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(LemlistService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LemlistService(
                username: $creds->get('lemlist', 'username', ''),
                password: $creds->get('lemlist', 'password', ''),
                baseUrl: $creds->get('lemlist', 'url', 'https://api.lemlist.com/api'),
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
                ->register(new LemlistToolProvider());
        }
    }
}
