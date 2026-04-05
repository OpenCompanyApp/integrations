<?php

namespace OpenCompany\Integrations\Mollie;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MollieServiceProvider extends ServiceProvider
{
    /**
     * Register the Mollie service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(MollieService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MollieService(
                accessToken: $creds->get('mollie', 'access_token', ''),
                baseUrl: $creds->get('mollie', 'url', 'https://api.mollie.com/v2'),
            );
        });
    }

    /**
     * Boot the Mollie service provider.
     *
     * Registers the tool provider with the ToolProviderRegistry when available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MollieToolProvider());
        }
    }
}
