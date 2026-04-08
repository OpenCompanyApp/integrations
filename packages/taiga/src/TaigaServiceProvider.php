<?php

namespace OpenCompany\Integrations\Taiga;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TaigaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TaigaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TaigaService(
                accessToken: $creds->get('taiga', 'access_token', ''),
                baseUrl: $creds->get('taiga', 'url', 'https://api.taiga.io/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TaigaToolProvider());
        }
    }
}
