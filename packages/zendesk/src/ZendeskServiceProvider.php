<?php

namespace OpenCompany\Integrations\Zendesk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the ZendeskService singleton and bootstraps Zendesk tools.
 */
class ZendeskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZendeskService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZendeskService(
                accessToken: $creds->get('zendesk', 'access_token', ''),
                baseUrl: $creds->get('zendesk', 'base_url', 'https://api.zendesk.com/v2'),
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
