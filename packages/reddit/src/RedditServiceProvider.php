<?php

namespace OpenCompany\Integrations\Reddit;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RedditServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RedditService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RedditService(
                accessToken: $creds->get('reddit', 'access_token', ''),
                baseUrl: $creds->get('reddit', 'url', 'https://oauth.reddit.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RedditToolProvider());
        }
    }
}
