<?php

namespace OpenCompany\Integrations\ChartMogul;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ChartMogulServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ChartMogulService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ChartMogulService(
                apiKey: $creds->get('chartmogul', 'api_key', ''),
                baseUrl: $creds->get('chartmogul', 'url', 'https://api.chartmogul.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ChartMogulToolProvider());
        }
    }
}
