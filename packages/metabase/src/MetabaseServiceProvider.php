<?php

namespace OpenCompany\Integrations\Metabase;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MetabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MetabaseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MetabaseService(
                username: $creds->get('metabase', 'username', ''),
                password: $creds->get('metabase', 'password', ''),
                hostname: $creds->get('metabase', 'hostname', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MetabaseToolProvider());
        }
    }
}
