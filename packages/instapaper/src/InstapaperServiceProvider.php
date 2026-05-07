<?php

namespace OpenCompany\Integrations\Instapaper;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Instapaper integration with Laravel.
 *
 * Binds the OAuth-aware API client from host credentials and registers the
 * tool provider with the shared registry when available.
 */
class InstapaperServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(InstapaperService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new InstapaperService(
                consumerKey: $creds->get('instapaper', 'consumer_key', ''),
                consumerSecret: $creds->get('instapaper', 'consumer_secret', ''),
                oauthToken: $creds->get('instapaper', 'oauth_token', ''),
                oauthTokenSecret: $creds->get('instapaper', 'oauth_token_secret', ''),
                simpleUsername: $creds->get('instapaper', 'simple_username', ''),
                simplePassword: $creds->get('instapaper', 'simple_password', ''),
                baseUrl: $creds->get('instapaper', 'url', 'https://www.instapaper.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new InstapaperToolProvider());
        }
    }
}
