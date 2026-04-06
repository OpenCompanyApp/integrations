<?php

namespace OpenCompany\Integrations\ServiceM8;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ServiceM8ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ServiceM8Service::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ServiceM8Service(
                accessToken: $creds->get('service_m8', 'access_token', ''),
                baseUrl: $creds->get('service_m8', 'url', 'https://api.servicem8.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ServiceM8ToolProvider());
        }
    }
}
