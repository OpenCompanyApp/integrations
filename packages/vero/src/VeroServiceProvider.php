<?php

namespace OpenCompany\Integrations\Vero;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class VeroServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VeroService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new VeroService(
                authToken: $creds->get('vero', 'auth_token', ''),
                baseUrl: $creds->get('vero', 'url', 'https://api.getvero.com/api/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new VeroToolProvider());
        }
    }
}
