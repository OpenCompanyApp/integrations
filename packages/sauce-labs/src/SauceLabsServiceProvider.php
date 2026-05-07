<?php

namespace OpenCompany\Integrations\SauceLabs;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Sauce Labs integration with Laravel.
 *
 * Binds the Sauce Labs API client from host credentials and registers the tool
 * provider when the shared registry is available.
 */
class SauceLabsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SauceLabsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SauceLabsService(
                username: $creds->get('sauce-labs', 'username', ''),
                accessKey: $creds->get('sauce-labs', 'access_key', ''),
                baseUrl: $creds->get('sauce-labs', 'url', 'https://api.us-west-1.saucelabs.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new SauceLabsToolProvider());
        }
    }
}
