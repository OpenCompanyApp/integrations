<?php

namespace OpenCompany\Integrations\Revolut;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Revolut integration package.
 */
class RevolutServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RevolutService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RevolutService(
                accessToken: $creds->get('revolut', 'access_token', ''),
                baseUrl: $creds->get('revolut', 'url', 'https://b2b.revolut.com/api/1.0'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RevolutToolProvider());
        }
    }
}
