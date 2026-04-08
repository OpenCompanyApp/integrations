<?php

namespace OpenCompany\Integrations\Linear;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the LinearService singleton and bootstraps Linear tools.
 */
class LinearServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LinearService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LinearService(
                apiKey: $creds->get('linear', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LinearToolProvider());
        }
    }
}
