<?php

namespace OpenCompany\Integrations\Freshsales;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FreshsalesServiceProvider extends ServiceProvider
{
    /**
     * Register the Freshsales service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(FreshsalesService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FreshsalesService(
                apiKey: $creds->get('freshsales', 'api_key', ''),
                domain: $creds->get('freshsales', 'domain', ''),
            );
        });
    }

    /**
     * Boot the Freshsales service provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshsalesToolProvider());
        }
    }
}
