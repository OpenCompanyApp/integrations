<?php

namespace OpenCompany\Integrations\SproutSocial;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SproutSocialServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SproutSocialService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SproutSocialService(
                accessToken: $creds->get('sproutsocial', 'access_token', ''),
                baseUrl: $creds->get('sproutsocial', 'url', 'https://api.sproutsocial.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SproutSocialToolProvider());
        }
    }
}
