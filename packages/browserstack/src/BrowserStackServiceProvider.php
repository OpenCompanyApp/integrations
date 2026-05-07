<?php

namespace OpenCompany\Integrations\BrowserStack;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the BrowserStack integration with Laravel.
 *
 * Binds the BrowserStack API client from host credentials and registers the
 * tool provider when the shared registry is available.
 */
class BrowserStackServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BrowserStackService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BrowserStackService(
                username: $creds->get('browserstack', 'username', ''),
                accessKey: $creds->get('browserstack', 'access_key', ''),
                baseUrl: $creds->get('browserstack', 'url', 'https://api.browserstack.com'),
                cloudBaseUrl: $creds->get('browserstack', 'cloud_url', 'https://api-cloud.browserstack.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new BrowserStackToolProvider());
        }
    }
}
