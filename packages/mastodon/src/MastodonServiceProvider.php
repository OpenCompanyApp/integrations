<?php

namespace OpenCompany\Integrations\Mastodon;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * MastodonServiceProvider — registers the Mastodon service and tool provider.
 *
 * Auto-discovered by Laravel. Binds MastodonService as a singleton using
 * credentials from the CredentialResolver, and registers the tool provider
 * with the ToolProviderRegistry.
 */
class MastodonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MastodonService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MastodonService(
                accessToken: $creds->get('mastodon', 'access_token', ''),
                baseUrl: $creds->get('mastodon', 'instance_url', 'https://mastodon.social'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MastodonToolProvider());
        }
    }
}
