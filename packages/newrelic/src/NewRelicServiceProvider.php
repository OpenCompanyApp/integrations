<?php

namespace OpenCompany\Integrations\NewRelic;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class NewRelicServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NewRelicService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new NewRelicService(
                apiKey: $creds->get('newrelic', 'api_key', ''),
                accountId: $creds->get('newrelic', 'account_id', ''),
                baseUrl: $creds->get('newrelic', 'url', 'https://api.newrelic.com/graphql'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new NewRelicToolProvider());
        }
    }
}
