<?php

namespace OpenCompany\Integrations\Prometheus;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PrometheusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PrometheusService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new PrometheusService(
                apiToken: $creds->get('prometheus', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PrometheusToolProvider());
        }
    }
}
