<?php

namespace OpenCompany\Integrations\ZendeskSell;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ZendeskSellServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZendeskSellService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZendeskSellService(
                accessToken: $creds->get('zendesk-sell', 'access_token', ''),
                baseUrl: $creds->get('zendesk-sell', 'url', 'https://api.getbase.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZendeskSellToolProvider());
        }
    }
}
