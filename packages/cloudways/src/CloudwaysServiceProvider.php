<?php

namespace OpenCompany\Integrations\Cloudways;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CloudwaysServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CloudwaysService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new CloudwaysService(
                accessToken: $creds->get('cloudways', 'access_token', ''),
                baseUrl: $creds->get('cloudways', 'url', 'https://api.cloudways.com/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CloudwaysToolProvider());
        }
    }
}
