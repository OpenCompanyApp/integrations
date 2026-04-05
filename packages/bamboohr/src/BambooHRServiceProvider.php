<?php

namespace OpenCompany\Integrations\BambooHR;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the BambooHR integration.
 *
 * Registers the BambooHRService as a singleton (credentials resolved once
 * per request lifecycle) and boots the tool provider into the registry
 * when integration-core is available.
 */
class BambooHRServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BambooHRService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BambooHRService(
                apiKey: $creds->get('bamboohr', 'api_key', ''),
                subdomain: $creds->get('bamboohr', 'subdomain', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BambooHRToolProvider());
        }
    }
}
