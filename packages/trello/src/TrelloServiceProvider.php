<?php

namespace OpenCompany\Integrations\Trello;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Trello integration.
 *
 * Registers the TrelloService singleton and bootstraps the Trello tool provider.
 */
class TrelloServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TrelloService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TrelloService(
                apiKey: $creds->get('trello', 'api_key', ''),
                apiToken: $creds->get('trello', 'api_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TrelloToolProvider());
        }
    }
}
