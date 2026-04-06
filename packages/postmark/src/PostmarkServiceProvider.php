<?php

namespace OpenCompany\Integrations\Postmark;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PostmarkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PostmarkService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PostmarkService(
                serverToken: $creds->get('postmark', 'server_token', ''),
                baseUrl: $creds->get('postmark', 'url', 'https://api.postmarkapp.com'),
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
