<?php

namespace OpenCompany\Integrations\MicrosoftEducation;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Education integration with Laravel.
 *
 * Binds the Graph-backed education service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftEducationServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftEducationService::class, function ($app): MicrosoftEducationService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftEducationService(accessToken: $creds?->get('microsoft-education', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-education', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftEducationToolProvider); } }
}
