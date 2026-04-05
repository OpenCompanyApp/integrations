<?php

namespace OpenCompany\Integrations\Figma;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Figma integration.
 *
 * Registers the FigmaService singleton and bootstraps the Figma tool provider.
 */
class FigmaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FigmaService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FigmaService(
                apiToken: $creds->get('figma', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FigmaToolProvider());
        }
    }
}
