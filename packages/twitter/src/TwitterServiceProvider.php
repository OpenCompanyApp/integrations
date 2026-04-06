<?php

namespace OpenCompany\Integrations\Twitter;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

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
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TwitterToolProvider());
        }
    }
}
