<?php

namespace OpenCompany\Integrations\Reddit;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Reddit integration package.
 *
 * Registers the RedditService singleton with credentials resolved from the
 * integration core, and boots the tool provider into the registry for
 * auto-discovery by the AI agent system.
 */
class RedditServiceProvider extends ServiceProvider
{
    /**
     * Register the RedditService singleton.
     *
     * Resolves OAuth2 credentials (access token, optional base URL,
     * and user-agent) from the configured credential resolver and
     * binds the service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(RedditService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RedditService(
                accessToken: $creds->get('reddit', 'access_token', ''),
                baseUrl: $creds->get('reddit', 'url', 'https://oauth.reddit.com'),
                userAgent: $creds->get('reddit', 'user_agent', 'OpenCompany/1.0'),
            );
        });
    }

    /**
     * Boot the Reddit tool provider into the ToolProviderRegistry.
     *
     * Only registers if the ToolProviderRegistry is bound in the container,
     * allowing safe use in non-OpenCompany Laravel applications.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RedditToolProvider());
        }
    }
}
