<?php

namespace OpenCompany\Integrations\MySQL;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MySQLServiceProvider extends ServiceProvider
{
    /**
     * Register the MySQL service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(MySQLService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MySQLService(
                apiKey: $creds->get('mysql', 'api_key', ''),
                baseUrl: $creds->get('mysql', 'host', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MySQLToolProvider());
        }
    }
}
