<?php

namespace OpenCompany\Integrations\Sendy;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SendyServiceProvider extends ServiceProvider
{
    /**
     * Register the Sendy service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(SendyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SendyService(
                apiKey: $creds->get('sendy', 'api_key', ''),
                baseUrl: $creds->get('sendy', 'hostname', ''),
            );
        });
    }

    /**
     * Boot the Sendy service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SendyToolProvider());
        }
    }
}
