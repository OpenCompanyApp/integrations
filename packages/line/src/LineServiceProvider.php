<?php

namespace OpenCompany\Integrations\Line;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the LINE Messaging integration with Laravel's service container.
 *
 * Binds the LINE API client and registers the tool provider for discovery.
 */
class LineServiceProvider extends ServiceProvider
{
    /**
     * Register the LINE service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(LineService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LineService(
                accessToken: $creds->get('line', 'access_token', ''),
                baseUrl: $creds->get('line', 'url', 'https://api.line.me'),
            );
        });
    }

    /**
     * Register the LINE tool provider when the registry is available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LineToolProvider());
        }
    }
}
