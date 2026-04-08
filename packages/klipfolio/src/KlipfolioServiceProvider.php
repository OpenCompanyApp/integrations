<?php

namespace OpenCompany\Integrations\Klipfolio;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Klipfolio integration.
 *
 * Registers the KlipfolioService singleton and boots the tool provider
 * into the ToolProviderRegistry when available.
 */
class KlipfolioServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KlipfolioService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new KlipfolioService(
                accessToken: $creds->get('klipfolio', 'access_token', ''),
                baseUrl: $creds->get('klipfolio', 'url', 'https://app.klipfolio.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new KlipfolioToolProvider());
        }
    }
}
