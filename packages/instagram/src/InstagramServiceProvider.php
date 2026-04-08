<?php

namespace OpenCompany\Integrations\Instagram;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class InstagramServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(InstagramService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new InstagramService(
                accessToken: $creds->get('instagram', 'access_token', ''),
                baseUrl: $creds->get('instagram', 'url', 'https://graph.instagram.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new InstagramToolProvider());
        }
    }
}
