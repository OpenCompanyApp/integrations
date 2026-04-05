<?php

namespace OpenCompany\Integrations\Exa;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Exa AI search integration.
 *
 * Registers the ExaService as a singleton (credentials resolved once per request)
 * and bootstraps the ExaToolProvider into the ToolProviderRegistry when available.
 */
class ExaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ExaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ExaService(
                apiKey: $creds->get('exa', 'api_key', ''),
                baseUrl: $creds->get('exa', 'url', 'https://api.exa.ai'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ExaToolProvider());
        }
    }
}
