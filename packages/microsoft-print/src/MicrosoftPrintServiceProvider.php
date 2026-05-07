<?php

namespace OpenCompany\Integrations\MicrosoftPrint;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Universal Print integration with Laravel.
 *
 * Binds the Graph-backed print service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftPrintServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftPrintService::class, function ($app): MicrosoftPrintService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftPrintService(accessToken: $creds?->get('microsoft-print', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-print', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftPrintToolProvider); } }
}
