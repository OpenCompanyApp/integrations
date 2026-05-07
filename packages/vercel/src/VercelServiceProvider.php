<?php

namespace OpenCompany\Integrations\Vercel;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Vercel integration with Laravel.
 *
 * Binds the Vercel REST API client from host credentials and registers the
 * provider with the shared discovery registry when available.
 */
class VercelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VercelService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new VercelService(
                token: $creds->get('vercel', 'token', ''),
                baseUrl: $creds->get('vercel', 'url', 'https://api.vercel.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new VercelToolProvider());
        }
    }
}
