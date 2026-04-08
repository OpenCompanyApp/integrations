<?php

namespace OpenCompany\Integrations\Calendly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Calendly integration.
 *
 * Registers the CalendlyService singleton and bootstraps the Calendly tool provider.
 */
class CalendlyServiceProvider extends ServiceProvider
{
    /**
     * Register the CalendlyService singleton.
     *
     * Resolves the Personal Access Token via the CredentialResolver
     * and binds CalendlyService into the container.
     */
    public function register(): void
    {
        $this->app->singleton(CalendlyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CalendlyService(
                accessToken: $creds->get('calendly', 'access_token', ''),
            );
        });
    }

    /**
     * Boot the service provider.
     *
     * Registers the CalendlyToolProvider with the ToolProviderRegistry
     * when the registry is bound in the container.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CalendlyToolProvider());
        }
    }
}
