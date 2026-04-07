<?php

namespace OpenCompany\Integrations\Fauna;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the FaunaService singleton and bootstraps Fauna tools.
 */
class FaunaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FaunaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FaunaService(
                bearerToken: $creds->get('fauna', 'bearer_token', ''),
                baseUrl: $creds->get('fauna', 'base_url', 'https://db.fauna.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FaunaToolProvider());
        }
    }
}
