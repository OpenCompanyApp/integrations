<?php

namespace OpenCompany\Integrations\GoogleAds;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Ads integration with Laravel's service container.
 *
 * Binds GoogleAdsService using OAuth and developer-token credentials, and registers
 * GoogleAdsToolProvider with the shared ToolProviderRegistry.
 */
class GoogleAdsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleAdsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            $expiresAt = $creds->get('google_ads', 'expires_at');

            return new GoogleAdsService(
                clientId: $creds->get('google_ads', 'client_id', ''),
                clientSecret: $creds->get('google_ads', 'client_secret', ''),
                accessToken: $creds->get('google_ads', 'access_token', ''),
                refreshToken: $creds->get('google_ads', 'refresh_token', ''),
                expiresAt: is_numeric($expiresAt) ? (int) $expiresAt : null,
                developerToken: $creds->get('google_ads', 'developer_token', ''),
                managerCustomerId: $creds->get('google_ads', 'manager_customer_id', ''),
                defaultCustomerId: $creds->get('google_ads', 'default_customer_id', ''),
                linkedCustomerId: $creds->get('google_ads', 'linked_customer_id', ''),
                apiVersion: $creds->get('google_ads', 'api_version', 'v24'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleAdsToolProvider());
        }
    }
}
