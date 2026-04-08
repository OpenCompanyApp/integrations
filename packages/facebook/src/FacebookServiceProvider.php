<?php

namespace OpenCompany\Integrations\Facebook;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FacebookServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FacebookService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FacebookService(
                accessToken: $creds->get('facebook', 'access_token', ''),
                baseUrl: $creds->get('facebook', 'base_url', 'https://graph.facebook.com/v21.0'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FacebookToolProvider());
        }
    }
}
