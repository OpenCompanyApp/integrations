<?php

namespace OpenCompany\Integrations\ZendeskSell;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Zendesk Sell integration with Laravel.
 *
 * Binds the API service using stored credentials and registers the tool
 * provider when the integration-core registry is available.
 */
class ZendeskSellServiceProvider extends ServiceProvider
{
    /**
     * Register the Zendesk Sell service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ZendeskSellService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZendeskSellService(
                accessToken: $creds->get('zendesk-sell', 'access_token', ''),
                baseUrl: $creds->get('zendesk-sell', 'url', 'https://api.getbase.com'),
            );
        });
    }

    /**
     * Register Zendesk Sell tools with the provider registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZendeskSellToolProvider());
        }
    }
}
