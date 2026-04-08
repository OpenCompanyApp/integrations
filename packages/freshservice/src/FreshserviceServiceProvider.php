<?php

namespace OpenCompany\Integrations\Freshservice;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FreshserviceServiceProvider extends ServiceProvider
{
    /**
     * Register the Freshservice service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(FreshserviceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FreshserviceService(
                apiKey: $creds->get('freshservice', 'api_key', ''),
                domain: $creds->get('freshservice', 'domain', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshserviceToolProvider());
        }
    }
}
