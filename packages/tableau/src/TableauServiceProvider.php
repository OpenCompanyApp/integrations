<?php

namespace OpenCompany\Integrations\Tableau;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TableauServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TableauService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TableauService(
                accessToken: $creds->get('tableau', 'access_token', ''),
                siteId: $creds->get('tableau', 'site_id', ''),
                baseUrl: $creds->get('tableau', 'base_url', 'https://your-tableau-server.com/api/3.23'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TableauToolProvider());
        }
    }
}
