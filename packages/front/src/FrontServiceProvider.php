<?php

namespace OpenCompany\Integrations\Front;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Front integration with Laravel's service container.
 *
 * Binds the Front API client from stored credentials and registers the tool
 * provider with the integration registry when available.
 */
class FrontServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FrontService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FrontService(
                accessToken: $creds->get('front', 'access_token', ''),
                baseUrl: $creds->get('front', 'url', 'https://api2.frontapp.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FrontToolProvider());
        }
    }
}
