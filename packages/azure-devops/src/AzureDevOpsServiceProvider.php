<?php

namespace OpenCompany\Integrations\AzureDevOps;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Azure DevOps integration with Laravel.
 *
 * Binds AzureDevOpsService using host-managed credentials and registers the
 * provider with the shared integration registry when available.
 */
class AzureDevOpsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AzureDevOpsService::class, function ($app): AzureDevOpsService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new AzureDevOpsService(
                personalAccessToken: $creds?->get('azure-devops', 'personal_access_token', '') ?? '',
                accessToken: $creds?->get('azure-devops', 'access_token', '') ?? '',
                baseUrl: $creds?->get('azure-devops', 'base_url', '') ?? '',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new AzureDevOpsToolProvider);
        }
    }
}
