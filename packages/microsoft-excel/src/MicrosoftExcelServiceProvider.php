<?php

namespace OpenCompany\Integrations\MicrosoftExcel;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Excel integration with Laravel.
 *
 * Binds the Graph-backed Excel workbook service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftExcelServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftExcelService::class, function ($app): MicrosoftExcelService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftExcelService(accessToken: $creds?->get('microsoft-excel', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-excel', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftExcelToolProvider); } }
}
