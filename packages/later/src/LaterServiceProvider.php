<?php

namespace OpenCompany\Integrations\Later;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LaterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LaterService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LaterService(
                accessToken: $creds->get('later', 'access_token', ''),
                baseUrl: $creds->get('later', 'url', 'https://api.later.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LaterToolProvider());
        }
    }
}
