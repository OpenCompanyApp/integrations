<?php

namespace OpenCompany\Integrations\GoogleKeep;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Keep integration with Laravel's service container.
 *
 * Binds GoogleKeepService from host credentials and registers the generated
 * GoogleKeepToolProvider with the shared provider registry.
 */
class GoogleKeepServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleKeepService::class, function ($app): GoogleKeepService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleKeepService(accessToken: $creds?->get('google-keep', 'access_token', '') ?? '', baseUrl: $creds?->get('google-keep', 'url', 'https://keep.googleapis.com') ?? 'https://keep.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleKeepToolProvider);
    }
}