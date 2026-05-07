<?php

namespace OpenCompany\Integrations\CockroachDb;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the CockroachDB Cloud integration with Laravel's service container.
 *
 * Binds the API service and registers the generated tool provider.
 */
class CockroachDbServiceProvider extends ServiceProvider
{
    /**
     * Register the CockroachDB Cloud service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(CockroachDbService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CockroachDbService(
                accessToken: $creds->get('cockroachdb', 'access_token', ''),
                baseUrl: $creds->get('cockroachdb', 'url', 'https://cockroachlabs.cloud'),
            );
        });
    }

    /**
     * Register the tool provider when the host registry is available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CockroachDbToolProvider());
        }
    }
}
