<?php

namespace OpenCompany\Integrations\YouTube;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the YouTube integration with Laravel's service container.
 *
 * Binds YouTubeService from host credentials and registers the generated
 * YouTubeToolProvider with the shared provider registry.
 */
class YouTubeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(YouTubeService::class, function ($app): YouTubeService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new YouTubeService(accessToken: $creds?->get('youtube', 'access_token', '') ?? '', apiKey: $creds?->get('youtube', 'api_key', '') ?? '', baseUrl: $creds?->get('youtube', 'url', 'https://youtube.googleapis.com') ?? 'https://youtube.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new YouTubeToolProvider);
    }
}
