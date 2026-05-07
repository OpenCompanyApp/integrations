<?php

namespace OpenCompany\Integrations\MicrosoftReports;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Reports integration with Laravel.
 *
 * Binds the Graph-backed reports service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftReportsServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftReportsService::class, function ($app): MicrosoftReportsService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftReportsService(accessToken: $creds?->get('microsoft-reports', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-reports', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftReportsToolProvider); } }
}
