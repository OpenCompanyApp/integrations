<?php

namespace OpenCompany\Integrations\Vonage;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class VonageServiceProvider extends ServiceProvider
{
    /**
     * Register the Vonage service as a singleton.
     */
    public function register(): void
    {
        $this->app->singleton(VonageService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new VonageService(
                apiKey: $creds->get('vonage', 'api_key', ''),
                apiSecret: $creds->get('vonage', 'api_secret', ''),
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
                ->register(new VonageToolProvider());
        }
    }
}
