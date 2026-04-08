<?php

namespace OpenCompany\Integrations\ArgoCd;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Argo CD integration with Laravel's service container.
 *
 * Binds the ArgoCdService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class ArgoCdServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ArgoCdService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new ArgoCdService(
                token: $creds->get('argocd', 'api_key', ''),
                baseUrl: $creds->get('argocd', 'base_url', 'https://api.argocd.io/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ArgoCdToolProvider());
        }
    }
}
