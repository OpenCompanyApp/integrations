<?php

namespace OpenCompany\Integrations\Postmark;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Postmark integration.
 *
 * Registers the PostmarkService singleton and bootstraps the Postmark tool provider.
 */
class PostmarkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PostmarkService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PostmarkService(
                serverToken: $creds->get('postmark', 'server_token', ''),
                baseUrl: $creds->get('postmark', 'base_url', 'https://api.postmarkapp.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PostmarkToolProvider());
        }
    }
}
