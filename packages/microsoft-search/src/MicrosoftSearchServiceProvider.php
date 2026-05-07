<?php

namespace OpenCompany\Integrations\MicrosoftSearch;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Search integration with Laravel.
 *
 * Binds the Graph-backed search service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftSearchServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftSearchService::class, function ($app): MicrosoftSearchService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftSearchService(accessToken: $creds?->get('microsoft-search', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-search', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftSearchToolProvider); } }
}
