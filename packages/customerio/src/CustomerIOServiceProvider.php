<?php

namespace OpenCompany\Integrations\CustomerIO;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CustomerIOServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CustomerIOService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CustomerIOService(
                apiKey: $creds->get('customerio', 'api_key', ''),
                baseUrl: $creds->get('customerio', 'url', 'https://api.customer.io/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CustomerIOToolProvider());
        }
    }
}
