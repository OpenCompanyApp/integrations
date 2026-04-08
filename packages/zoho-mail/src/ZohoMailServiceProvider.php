<?php

namespace OpenCompany\Integrations\ZohoMail;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Zoho Mail integration.
 *
 * Registers the ZohoMailService as a singleton and boots the tool provider
 * into the ToolProviderRegistry for auto-discovery.
 */
class ZohoMailServiceProvider extends ServiceProvider
{
    /**
     * Register the ZohoMailService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ZohoMailService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZohoMailService(
                accessToken: $creds->get('zoho-mail', 'access_token', ''),
                baseUrl: $creds->get('zoho-mail', 'url', 'https://mail.zoho.com/api/v1'),
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
                ->register(new ZohoMailToolProvider());
        }
    }
}
