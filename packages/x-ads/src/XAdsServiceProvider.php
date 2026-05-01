<?php

namespace OpenCompany\Integrations\XAds;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the generated X Ads integration.
 *
 * Binds the OAuth 1.0a signed Ads API service and registers the generated
 * tools with the host registry when available.
 */
class XAdsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(XAdsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new XAdsService(
                apiKey: $creds->get('x_ads', 'api_key', ''),
                apiSecret: $creds->get('x_ads', 'api_secret', ''),
                accessToken: $creds->get('x_ads', 'access_token', ''),
                accessTokenSecret: $creds->get('x_ads', 'access_token_secret', ''),
                accountId: $creds->get('x_ads', 'account_id', ''),
                apiVersion: $creds->get('x_ads', 'api_version', '11'),
                baseUrl: $creds->get('x_ads', 'base_url', 'https://ads-api.x.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new XAdsToolProvider());
        }
    }
}