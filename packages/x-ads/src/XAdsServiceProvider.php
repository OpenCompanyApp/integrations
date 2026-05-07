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
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('x-ads', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('x_ads', $key, $default);
            };

            return new XAdsService(
                apiKey: $get('api_key'),
                apiSecret: $get('api_secret'),
                accessToken: $get('access_token'),
                accessTokenSecret: $get('access_token_secret'),
                accountId: $get('account_id'),
                apiVersion: $get('api_version', '12'),
                baseUrl: $get('base_url', 'https://ads-api.x.com'),
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
