<?php

namespace OpenCompany\Integrations\Canva;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CanvaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CanvaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CanvaService(
                accessToken: $creds->get('canva', 'access_token', ''),
                baseUrl: $creds->get('canva', 'url', 'https://api.canva.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CanvaToolProvider());
        }
    }
}
