<?php

namespace OpenCompany\Integrations\Weave;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WeaveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WeaveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WeaveService(
                accessToken: $creds->get('weave', 'access_token', ''),
                baseUrl: $creds->get('weave', 'url', 'https://api.getweave.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WeaveToolProvider());
        }
    }
}
