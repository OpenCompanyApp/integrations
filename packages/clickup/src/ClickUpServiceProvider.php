<?php

namespace OpenCompany\Integrations\ClickUp;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ClickUp integration with Laravel's service container.
 *
 * Binds the ClickUp API client and registers the tool provider when the host
 * exposes a ToolProviderRegistry.
 */
class ClickUpServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ClickUpService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ClickUpService(
                apiToken: $creds->get('clickup', 'api_token', ''),
                workspaceId: $creds->get('clickup', 'workspace_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ClickUpToolProvider());
        }
    }
}
