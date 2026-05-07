<?php

namespace OpenCompany\Integrations\Pushbullet;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Pushbullet integration with Laravel.
 *
 * Binds the Pushbullet API client and registers the tool provider for discovery.
 */
class PushbulletServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PushbulletService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PushbulletService(
                accessToken: $creds->get('pushbullet', 'access_token', ''),
                baseUrl: $creds->get('pushbullet', 'url', 'https://api.pushbullet.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PushbulletToolProvider());
        }
    }
}
