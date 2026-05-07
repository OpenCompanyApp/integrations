<?php

namespace OpenCompany\Integrations\GoogleTranslate;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Translate integration with Laravel's service container.
 *
 * Binds GoogleTranslateService from host credentials and registers the generated
 * GoogleTranslateToolProvider with the shared provider registry.
 */
class GoogleTranslateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleTranslateService::class, function ($app): GoogleTranslateService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleTranslateService(accessToken: $creds?->get('google-translate', 'access_token', '') ?? '', baseUrl: $creds?->get('google-translate', 'url', 'https://translate.googleapis.com') ?? 'https://translate.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleTranslateToolProvider);
    }
}
