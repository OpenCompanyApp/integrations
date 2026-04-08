<?php

namespace OpenCompany\Integrations\Contabo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ContaboServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ContaboService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ContaboService(
                accessToken: $creds->get('contabo', 'access_token', ''),
                baseUrl: $creds->get('contabo', 'url', 'https://api.contabo.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ContaboToolProvider());
        }
    }
}
