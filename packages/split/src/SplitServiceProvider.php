<?php

namespace OpenCompany\Integrations\Split;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SplitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SplitService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SplitService(
                accessToken: $creds->get('split', 'access_token', ''),
                workspaceId: $creds->get('split', 'workspace_id', ''),
                baseUrl: $creds->get('split', 'url', 'https://api.split.io/internal/api/v3'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SplitToolProvider());
        }
    }
}
