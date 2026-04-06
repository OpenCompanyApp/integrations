<?php

namespace OpenCompany\Integrations\Knock;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class KnockServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KnockService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KnockService(
                apiKey: $creds->get('knock', 'api_key', ''),
                baseUrl: $creds->get('knock', 'url', 'https://api.knock.app'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KnockToolProvider());
        }
    }
}
