<?php

namespace OpenCompany\Integrations\MicrosoftOneNote;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft OneNote integration with Laravel.
 *
 * Binds the Graph-backed OneNote service and registers the tool provider with
 * the shared integration registry when available.
 */
class MicrosoftOneNoteServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MicrosoftOneNoteService::class, function ($app): MicrosoftOneNoteService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new MicrosoftOneNoteService(accessToken: $creds?->get('microsoft-onenote', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-onenote', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftOneNoteToolProvider); } }
}
