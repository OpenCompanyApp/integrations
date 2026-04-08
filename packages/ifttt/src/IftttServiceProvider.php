<?php

namespace OpenCompany\Integrations\Ifttt;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the IFTTT integration.
 *
 * Registers the IftttService singleton and bootstraps the IFTTT tool provider.
 */
class IftttServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IftttService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new IftttService(
                accessToken: $creds->get('ifttt', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new IftttToolProvider());
        }
    }
}
