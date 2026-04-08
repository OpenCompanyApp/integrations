<?php

namespace OpenCompany\Integrations\Pipedream;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PipedreamServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PipedreamService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PipedreamService(
                accessToken: $creds->get('pipedream', 'access_token', ''),
                baseUrl: $creds->get('pipedream', 'url', 'https://api.pipedream.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PipedreamToolProvider());
        }
    }
}
