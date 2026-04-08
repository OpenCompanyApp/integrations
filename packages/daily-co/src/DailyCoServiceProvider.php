<?php

namespace OpenCompany\Integrations\DailyCo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class DailyCoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DailyCoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DailyCoService(
                apiKey: $creds->get('daily-co', 'api_key', ''),
                baseUrl: $creds->get('daily-co', 'url', 'https://api.daily.co/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DailyCoToolProvider());
        }
    }
}
