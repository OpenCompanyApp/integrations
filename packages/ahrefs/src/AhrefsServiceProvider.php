<?php

namespace OpenCompany\Integrations\Ahrefs;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AhrefsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AhrefsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AhrefsService(
                apiKey: $creds->get('ahrefs', 'api_key', ''),
                baseUrl: $creds->get('ahrefs', 'url', 'https://api.ahrefs.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AhrefsToolProvider());
        }
    }
}
