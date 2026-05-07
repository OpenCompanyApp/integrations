<?php

namespace OpenCompany\Integrations\Pushover;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Pushover integration with Laravel's service container.
 *
 * Binds the PushoverService from configured credentials and registers the tool provider on boot.
 */
class PushoverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PushoverService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PushoverService(
                apiKey: $creds->get('pushover', 'api_key', ''),
                userKey: $creds->get('pushover', 'user_key', ''),
                baseUrl: $creds->get('pushover', 'url', 'https://api.pushover.net/1'),
                teamToken: $creds->get('pushover', 'team_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PushoverToolProvider());
        }
    }
}
