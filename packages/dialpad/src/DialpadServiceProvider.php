<?php

namespace OpenCompany\Integrations\Dialpad;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Dialpad integration.
 *
 * Registers the DialpadService singleton and boots the tool provider
 * into the ToolProviderRegistry when available.
 */
class DialpadServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DialpadService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DialpadService(
                accessToken: $creds->get('dialpad', 'access_token', ''),
                baseUrl: $creds->get('dialpad', 'url', 'https://dialpad.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DialpadToolProvider());
        }
    }
}
