<?php

namespace OpenCompany\Integrations\Crowdin;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CrowdinServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CrowdinService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CrowdinService(
                apiToken: $creds->get('crowdin', 'api_token', ''),
                baseUrl: $creds->get('crowdin', 'base_url', 'https://api.crowdin.com/api/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CrowdinToolProvider());
        }
    }
}
