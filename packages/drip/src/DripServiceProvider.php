<?php

namespace OpenCompany\Integrations\Drip;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class DripServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DripService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DripService(
                apiKey: $creds->get('drip', 'api_key', ''),
                accountId: $creds->get('drip', 'account_id', ''),
                baseUrl: $creds->get('drip', 'url', 'https://api.getdrip.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DripToolProvider());
        }
    }
}
