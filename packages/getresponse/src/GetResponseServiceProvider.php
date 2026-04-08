<?php

namespace OpenCompany\Integrations\GetResponse;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GetResponseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GetResponseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GetResponseService(
                apiKey: $creds->get('getresponse', 'api_key', ''),
                baseUrl: $creds->get('getresponse', 'url', 'https://api.getresponse.com/v3'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GetResponseToolProvider());
        }
    }
}
