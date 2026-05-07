<?php

namespace OpenCompany\Integrations\MicrosoftPeople;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft People integration with Laravel.
 *
 * Binds the Graph-backed people service and registers the tool provider
 * with the shared integration registry when available.
 */
class MicrosoftPeopleServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftPeopleService::class, function ($app): MicrosoftPeopleService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftPeopleService(accessToken: $creds?->get('microsoft-people', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-people', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftPeopleToolProvider); } }
}
