<?php

namespace OpenCompany\Integrations\X;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the canonical Twitter / X integration.
 *
 * Binds the generated X API service and registers all OpenAPI-backed tools
 * with the integration registry when the host exposes one.
 */
class XServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(XService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new XService(
                bearerToken: $creds->get('x', 'bearer_token', ''),
                accessToken: $creds->get('x', 'access_token', ''),
                apiKey: $creds->get('x', 'api_key', ''),
                apiSecret: $creds->get('x', 'api_secret', ''),
                accessTokenSecret: $creds->get('x', 'access_token_secret', ''),
                baseUrl: $creds->get('x', 'base_url', 'https://api.x.com/2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new XToolProvider());
        }
    }
}