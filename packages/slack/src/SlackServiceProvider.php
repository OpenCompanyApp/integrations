<?php

namespace OpenCompany\Integrations\Slack;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Slack integration.
 *
 * Registers the SlackService singleton and bootstraps the Slack tool provider.
 */
class SlackServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SlackService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SlackService(
                botToken: $creds->get('slack', 'bot_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SlackToolProvider());
        }
    }
}
