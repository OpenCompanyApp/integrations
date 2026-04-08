<?php

namespace OpenCompany\Integrations\Kimai;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KimaiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KimaiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KimaiService(
                accessToken: $creds->get('kimai', 'access_token', ''),
                baseUrl: $creds->get('kimai', 'url', 'https://demo.kimai.org'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KimaiToolProvider());
        }
    }
}
