<?php

namespace OpenCompany\Integrations\Gorgias;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GorgiasServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GorgiasService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GorgiasService(
                accessToken: $creds->get('gorgias', 'access_token', ''),
                baseUrl: $creds->get('gorgias', 'url', 'https://api.gorgias.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GorgiasToolProvider());
        }
    }
}
