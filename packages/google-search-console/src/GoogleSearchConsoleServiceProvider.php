<?php

namespace OpenCompany\Integrations\GoogleSearchConsole;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Google\GoogleServiceProvider;

class GoogleSearchConsoleServiceProvider extends ServiceProvider
{
    private function shouldDeferToGoogleWorkspacePackage(): bool
    {
        return class_exists(GoogleServiceProvider::class);
    }

    public function register(): void
    {
        if ($this->shouldDeferToGoogleWorkspacePackage()) {
            return;
        }

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
        if ($this->shouldDeferToGoogleWorkspacePackage()) {
            return;
        }

        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleSearchConsoleToolProvider);
        }
    }
}
