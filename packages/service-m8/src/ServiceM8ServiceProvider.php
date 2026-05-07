<?php

namespace OpenCompany\Integrations\ServiceM8;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ServiceM8 integration with Laravel's service container.
 *
 * Binds the ServiceM8 API client from configured credentials and registers the
 * ServiceM8ToolProvider with the shared integration registry.
 */
class ServiceM8ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ServiceM8Service::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ServiceM8Service(
                accessToken: $creds->get('service-m8', 'access_token', '') ?: $creds->get('service_m8', 'access_token', ''),
                baseUrl: $creds->get('service-m8', 'url', '') ?: $creds->get('service_m8', 'url', 'https://api.servicem8.com/api_1.0'),
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
