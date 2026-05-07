<?php

namespace OpenCompany\Integrations\MicrosoftIntune;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Intune integration with Laravel.
 *
 * Binds the Graph-backed Intune service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftIntuneServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftIntuneService::class, function ($app): MicrosoftIntuneService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftIntuneService(accessToken: $creds?->get('microsoft-intune', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-intune', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftIntuneToolProvider); } }
}
