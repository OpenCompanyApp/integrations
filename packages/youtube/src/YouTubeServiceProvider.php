<?php

namespace OpenCompany\Integrations\YouTube;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the YouTube integration with Laravel's service container.
 *
 * Binds the YouTubeService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class YouTubeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(YouTubeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new YouTubeService(
                apiKey: $creds->get('youtube', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new YouTubeToolProvider());
        }
    }
}
