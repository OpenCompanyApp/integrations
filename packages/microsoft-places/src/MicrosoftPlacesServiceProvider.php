<?php

namespace OpenCompany\Integrations\MicrosoftPlaces;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Places integration with Laravel.
 *
 * Binds the Graph-backed places service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftPlacesServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftPlacesService::class, function ($app): MicrosoftPlacesService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftPlacesService(accessToken: $creds?->get('microsoft-places', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-places', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftPlacesToolProvider); } }
}
