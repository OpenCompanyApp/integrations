<?php

namespace OpenCompany\Integrations\GoogleSearchConsole;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Search Console integration with Laravel's service container.
 *
 * Binds GoogleSearchConsoleService from host credentials and registers the generated
 * GoogleSearchConsoleToolProvider with the shared provider registry.
 */
class GoogleSearchConsoleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleSearchConsoleService::class, function ($app): GoogleSearchConsoleService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleSearchConsoleService(accessToken: $creds?->get('google-search-console', 'access_token', '') ?? '', baseUrl: $creds?->get('google-search-console', 'url', 'https://searchconsole.googleapis.com') ?? 'https://searchconsole.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleSearchConsoleToolProvider);
    }
}
