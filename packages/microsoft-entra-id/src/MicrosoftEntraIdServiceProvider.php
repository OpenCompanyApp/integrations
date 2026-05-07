<?php

namespace OpenCompany\Integrations\MicrosoftEntraId;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Entra ID integration with Laravel.
 *
 * Binds the Graph-backed directory service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftEntraIdServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftEntraIdService::class, function ($app): MicrosoftEntraIdService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftEntraIdService(accessToken: $creds?->get('microsoft-entra-id', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-entra-id', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftEntraIdToolProvider); } }
}
