<?php

namespace OpenCompany\Integrations\TrustMrr;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TrustMrrServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TrustMrrService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TrustMrrService(
                apiKey: $creds->get('trustmrr', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TrustMrrToolProvider());
        }
    }
}
