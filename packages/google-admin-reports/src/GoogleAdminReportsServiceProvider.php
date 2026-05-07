<?php

namespace OpenCompany\Integrations\GoogleAdminReports;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Admin Reports integration with Laravel's service container.
 *
 * Binds GoogleAdminReportsService from host credentials and registers the generated
 * GoogleAdminReportsToolProvider with the shared provider registry.
 */
class GoogleAdminReportsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleAdminReportsService::class, function ($app): GoogleAdminReportsService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleAdminReportsService(accessToken: $creds?->get('google-admin-reports', 'access_token', '') ?? '', baseUrl: $creds?->get('google-admin-reports', 'url', 'https://admin.googleapis.com') ?? 'https://admin.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleAdminReportsToolProvider);
    }
}