<?php

namespace OpenCompany\Integrations\Onfleet;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class OnfleetServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OnfleetService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OnfleetService(
                apiKey: $creds->get('onfleet', 'api_key', ''),
                baseUrl: $creds->get('onfleet', 'url', 'https://onfleet.com/api/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new OnfleetToolProvider());
        }
    }
}
