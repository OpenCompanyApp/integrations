<?php

namespace OpenCompany\Integrations\PostHog;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the PostHog integration package.
 *
 * Registers the PostHogService as a singleton and boots the tool provider
 * into the ToolProviderRegistry so tools are discoverable at runtime.
 */
class PostHogServiceProvider extends ServiceProvider
{
    /**
     * Register the PostHogService singleton into the service container.
     */
    public function register(): void
    {
        $this->app->singleton(PostHogService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PostHogService(
                apiToken: $creds->get('posthog', 'api_token', ''),
                baseUrl: $creds->get('posthog', 'url', 'https://us.posthog.com'),
            );
        });
    }

    /**
     * Boot the service provider and register the PostHog tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PostHogToolProvider());
        }
    }
}
