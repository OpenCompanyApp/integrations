<?php

namespace OpenCompany\Integrations\Brevo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BrevoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BrevoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BrevoService(
                apiKey: $creds->get('brevo', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BrevoToolProvider());
        }
    }
}
