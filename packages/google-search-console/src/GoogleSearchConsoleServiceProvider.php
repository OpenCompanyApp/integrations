<?php

namespace OpenCompany\Integrations\GoogleSearchConsole;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GoogleSearchConsoleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleSearchConsoleService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleSearchConsoleService(
                accessToken: $creds->get('google-search-console', 'access_token', ''),
                baseUrl: $creds->get('google-search-console', 'url', 'https://searchconsole.googleapis.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleSearchConsoleToolProvider());
        }
    }
}
