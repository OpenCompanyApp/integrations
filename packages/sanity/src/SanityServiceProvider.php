<?php

namespace OpenCompany\Integrations\Sanity;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SanityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SanityService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SanityService(
                apiToken: $creds->get('sanity', 'api_token', ''),
                projectId: $creds->get('sanity', 'project_id', ''),
                dataset: $creds->get('sanity', 'dataset', 'production'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SanityToolProvider());
        }
    }
}
