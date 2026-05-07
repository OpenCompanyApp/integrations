<?php

namespace OpenCompany\Integrations\GoogleAppsScript;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Apps Script integration with Laravel's service container.
 *
 * Binds GoogleAppsScriptService from host credentials and registers the generated
 * GoogleAppsScriptToolProvider with the shared provider registry.
 */
class GoogleAppsScriptServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleAppsScriptService::class, function ($app): GoogleAppsScriptService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleAppsScriptService(accessToken: $creds?->get('google-apps-script', 'access_token', '') ?? '', baseUrl: $creds?->get('google-apps-script', 'url', 'https://script.googleapis.com') ?? 'https://script.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleAppsScriptToolProvider);
    }
}