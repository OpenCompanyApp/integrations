<?php

namespace OpenCompany\Integrations\Tally;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TallyServiceProvider extends ServiceProvider
{
    /**
     * Register the Tally service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(TallyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TallyService(
                apiKey: $creds->get('tally', 'api_key', ''),
                baseUrl: $creds->get('tally', 'url', 'https://api.tally.so'),
            );
        });
    }

    /**
     * Boot the Tally service provider — register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TallyToolProvider());
        }
    }
}
