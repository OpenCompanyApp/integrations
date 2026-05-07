<?php

namespace OpenCompany\Integrations\Paddle;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Paddle integration with Laravel's service container.
 *
 * Binds the Paddle service using stored credentials and registers the
 * Paddle tool provider with the shared integration registry when available.
 */
class PaddleServiceProvider extends ServiceProvider
{
    /**
     * Register the Paddle service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(PaddleService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PaddleService(
                accessToken: $creds->get('paddle', 'access_token', ''),
                baseUrl: $creds->get('paddle', 'url', 'https://sandbox-api.paddle.com'),
            );
        });
    }

    /**
     * Boot the Paddle service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PaddleToolProvider());
        }
    }
}
