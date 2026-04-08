<?php

namespace OpenCompany\Integrations\ClickSend;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the ClickSend integration.
 *
 * Registers the ClickSendService singleton and bootstraps the ClickSend tool provider.
 */
class ClickSendServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ClickSendService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ClickSendService(
                username: $creds->get('clicksend', 'username', ''),
                apiKey: $creds->get('clicksend', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ClickSendToolProvider());
        }
    }
}
