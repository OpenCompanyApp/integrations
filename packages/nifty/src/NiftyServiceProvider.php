<?php

namespace OpenCompany\Integrations\Nifty;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class NiftyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NiftyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NiftyService(
                accessToken: $creds->get('nifty', 'access_token', ''),
                baseUrl: $creds->get('nifty', 'url', 'https://api.niftyco.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new NiftyToolProvider());
        }
    }
}
