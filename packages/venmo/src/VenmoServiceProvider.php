<?php

namespace OpenCompany\Integrations\Venmo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Venmo integration package.
 */
class VenmoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VenmoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new VenmoService(
                accessToken: $creds->get('venmo', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new VenmoToolProvider());
        }
    }
}
