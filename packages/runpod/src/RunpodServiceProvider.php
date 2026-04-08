<?php

namespace OpenCompany\Integrations\Runpod;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RunpodServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RunpodService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RunpodService(
                accessToken: $creds->get('runpod', 'access_token', ''),
                baseUrl: $creds->get('runpod', 'url', 'https://api.runpod.io/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RunpodToolProvider());
        }
    }
}
