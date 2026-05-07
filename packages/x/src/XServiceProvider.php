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
            $bearerToken = (string) $creds->get('x', 'bearer_token', '');
            $accessToken = (string) $creds->get('x', 'access_token', '');
            $apiKey = (string) $creds->get('x', 'api_key', '');
            $apiSecret = (string) $creds->get('x', 'api_secret', '');
            $accessTokenSecret = (string) $creds->get('x', 'access_token_secret', '');
            $baseUrl = (string) $creds->get('x', 'base_url', '');

            if ($bearerToken === '') {
                $bearerToken = (string) $creds->get('twitter', 'bearer_token', '');
            }

            if ($bearerToken === '') {
                $bearerToken = (string) $creds->get('twitter', 'access_token', '');
            }

            if ($accessToken === '') {
                $accessToken = (string) $creds->get('twitter', 'oauth_access_token', '');
            }

            if ($apiKey === '') {
                $apiKey = (string) $creds->get('twitter', 'api_key', '');
            }

            if ($apiSecret === '') {
                $apiSecret = (string) $creds->get('twitter', 'api_secret', '');
            }

            if ($accessTokenSecret === '') {
                $accessTokenSecret = (string) $creds->get('twitter', 'access_token_secret', '');
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('twitter', 'url', 'https://api.x.com/2');
            }

            return new XService(
                bearerToken: $bearerToken,
                accessToken: $accessToken,
                apiKey: $apiKey,
                apiSecret: $apiSecret,
                accessTokenSecret: $accessTokenSecret,
                baseUrl: $baseUrl,
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
