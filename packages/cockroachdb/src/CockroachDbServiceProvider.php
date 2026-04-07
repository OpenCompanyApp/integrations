<?php

namespace OpenCompany\Integrations\CockroachDb;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CockroachDbServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CockroachDbService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CockroachDbService(
                accessToken: $creds->get('cockroachdb', 'access_token', ''),
                baseUrl: $creds->get('cockroachdb', 'url', 'https://cockroachlabs.cloud/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CockroachDbToolProvider());
        }
    }
}
