<?php

namespace OpenCompany\Integrations\ArgoCd;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Argo CD integration with Laravel's service container.
 *
 * Binds the Argo CD API client using host-provided credentials and registers
 * the Argo CD tool provider with the shared registry when available.
 */
class ArgoCdServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ArgoCdService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ArgoCdService(
                token: (string) $creds->get('argocd', 'api_key', ''),
                baseUrl: (string) $creds->get('argocd', 'base_url', 'https://argocd.example.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ArgoCdToolProvider);
        }
    }
}