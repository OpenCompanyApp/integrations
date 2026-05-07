<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Workspace Admin integration with Laravel's service container.
 *
 * Binds GoogleWorkspaceAdminService from host credentials and registers the generated
 * GoogleWorkspaceAdminToolProvider with the shared provider registry.
 */
class GoogleWorkspaceAdminServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleWorkspaceAdminService::class, function ($app): GoogleWorkspaceAdminService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleWorkspaceAdminService(accessToken: $creds?->get('google-workspace-admin', 'access_token', '') ?? '', baseUrl: $creds?->get('google-workspace-admin', 'url', 'https://admin.googleapis.com') ?? 'https://admin.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleWorkspaceAdminToolProvider);
    }
}