<?php

namespace OpenCompany\Integrations\Twitter;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;

/**
 * Registers legacy Twitter services without exposing duplicate tools.
 *
 * The canonical public integration is `x`. This provider keeps the old service
 * binding available for direct legacy consumers but intentionally avoids
 * registering `twitter` in the tool registry.
 */
class TwitterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TwitterService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TwitterService(
                accessToken: $creds->get('twitter', 'access_token', ''),
                baseUrl: $creds->get('twitter', 'url', 'https://api.twitter.com/2'),
            );
        });
    }

    public function boot(): void
    {
        // Deprecated compatibility package: do not register duplicate tools.
    }
}
