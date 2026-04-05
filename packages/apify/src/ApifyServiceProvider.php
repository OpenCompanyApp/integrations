<?php

namespace OpenCompany\Integrations\Apify;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ApifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ApifyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ApifyService(
                apiToken: $creds->get('apify', 'api_token', ''),
                baseUrl: $creds->get('apify', 'url', 'https://api.apify.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ApifyToolProvider());
        }
    }
}
