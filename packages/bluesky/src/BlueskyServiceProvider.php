<?php

namespace OpenCompany\Integrations\Bluesky;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Bluesky integration.
 *
 * Registers the {@see BlueskyService} singleton resolved from the
 * configured credentials and bootstraps the tool provider registry.
 */
class BlueskyServiceProvider extends ServiceProvider
{
    /**
     * Register the BlueskyService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(BlueskyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BlueskyService(
                accessToken: $creds->get('bluesky', 'access_token', ''),
                baseUrl: $creds->get('bluesky', 'url', 'https://bsky.social'),
                did: $creds->get('bluesky', 'did', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BlueskyToolProvider());
        }
    }
}
