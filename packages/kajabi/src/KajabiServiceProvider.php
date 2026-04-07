<?php

namespace OpenCompany\Integrations\Kajabi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KajabiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KajabiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KajabiService(
                accessToken: $creds->get('kajabi', 'access_token', ''),
                baseUrl: $creds->get('kajabi', 'url', 'https://app.kajabi.com/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KajabiToolProvider());
        }
    }
}
