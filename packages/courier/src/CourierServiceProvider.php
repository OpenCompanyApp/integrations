<?php

namespace OpenCompany\Integrations\Courier;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CourierServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CourierService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CourierService(
                apiKey: $creds->get('courier', 'api_key', ''),
                baseUrl: $creds->get('courier', 'url', 'https://api.courier.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CourierToolProvider());
        }
    }
}
