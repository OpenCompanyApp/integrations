<?php

namespace OpenCompany\Integrations\Bannerbear;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BannerbearServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BannerbearService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BannerbearService(
                apiKey: $creds->get('bannerbear', 'api_key', ''),
                baseUrl: $creds->get('bannerbear', 'url', 'https://api.bannerbear.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BannerbearToolProvider());
        }
    }
}
