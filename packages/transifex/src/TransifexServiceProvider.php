<?php

namespace OpenCompany\Integrations\Transifex;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TransifexServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TransifexService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TransifexService(
                apiToken: $creds->get('transifex', 'api_token', ''),
                baseUrl: $creds->get('transifex', 'base_url', 'https://api.transifex.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TransifexToolProvider());
        }
    }
}
