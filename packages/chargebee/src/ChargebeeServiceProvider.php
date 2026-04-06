<?php

namespace OpenCompany\Integrations\Chargebee;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Chargebee integration.
 *
 * Registers the ChargebeeService as a singleton and boots the
 * ChargebeeToolProvider into the ToolProviderRegistry.
 */
class ChargebeeServiceProvider extends ServiceProvider
{
    /**
     * Register the ChargebeeService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ChargebeeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ChargebeeService(
                accessToken: $creds->get('chargebee', 'access_token', ''),
                siteName: $creds->get('chargebee', 'site_name', ''),
            );
        });
    }

    /**
     * Boot the ChargebeeToolProvider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ChargebeeToolProvider());
        }
    }
}
