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
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('google-ads', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('google_ads', $key, $default);
            };

            $expiresAt = $get('expires_at', null);

            return new GoogleAdsService(
                clientId: $get('client_id'),
                clientSecret: $get('client_secret'),
                accessToken: $get('access_token'),
                refreshToken: $get('refresh_token'),
                expiresAt: is_numeric($expiresAt) ? (int) $expiresAt : null,
                developerToken: $get('developer_token'),
                managerCustomerId: $get('manager_customer_id'),
                defaultCustomerId: $get('default_customer_id'),
                linkedCustomerId: $get('linked_customer_id'),
                apiVersion: $get('api_version', 'v24'),
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
