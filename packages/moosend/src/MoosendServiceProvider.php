<?php

namespace OpenCompany\Integrations\Moosend;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MoosendServiceProvider extends ServiceProvider
{
    /**
     * Register the Moosend service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(MoosendService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MoosendService(
                apiKey: $creds->get('moosend', 'api_key', ''),
                baseUrl: 'https://api.moosend.com/v3',
            );
        });
    }

    /**
     * Boot the Moosend service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MoosendToolProvider());
        }
    }
}
