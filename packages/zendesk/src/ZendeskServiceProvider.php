<?php

namespace OpenCompany\Integrations\Zendesk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Zendesk integration with Laravel's service container.
 *
 * Binds the ZendeskService as a singleton and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class ZendeskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZendeskService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new ZendeskService(
                email: $creds->get('zendesk', 'email', ''),
                apiToken: $creds->get('zendesk', 'api_token', ''),
                subdomain: $creds->get('zendesk', 'subdomain', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZendeskToolProvider());
        }
    }
}
