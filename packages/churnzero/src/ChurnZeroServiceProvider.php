<?php

namespace OpenCompany\Integrations\ChurnZero;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the ChurnZero HTTP API integration.
 *
 * Registers the ChurnZeroService singleton and bootstraps the tool provider
 * with the ToolProviderRegistry when available.
 */
class ChurnZeroServiceProvider extends ServiceProvider
{
    /**
     * Register the ChurnZeroService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ChurnZeroService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            $legacyApiKey = $creds->get('churnzero', 'api_key', '');

            return new ChurnZeroService(
                appKey: $creds->get('churnzero', 'app_key', $legacyApiKey),
                endpoint: $creds->get('churnzero', 'url', 'https://analytics.churnzero.net/i'),
            );
        });
    }

    /**
     * Boot the service provider and register tools with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ChurnZeroToolProvider());
        }
    }
}
