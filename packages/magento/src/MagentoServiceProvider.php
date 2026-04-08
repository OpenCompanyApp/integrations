<?php

namespace OpenCompany\Integrations\Magento;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Magento integration.
 *
 * Registers the MagentoService as a singleton and boots the tool provider
 * into the ToolProviderRegistry.
 */
class MagentoServiceProvider extends ServiceProvider
{
    /**
     * Register the MagentoService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(MagentoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MagentoService(
                accessToken: $creds->get('magento', 'access_token', ''),
                baseUrl: $creds->get('magento', 'url', 'https://api.magento.com/v1'),
            );
        });
    }

    /**
     * Boot the Magento tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MagentoToolProvider());
        }
    }
}
