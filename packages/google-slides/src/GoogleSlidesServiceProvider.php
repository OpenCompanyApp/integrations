<?php

namespace OpenCompany\Integrations\GoogleSlides;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Slides integration with Laravel's service container.
 *
 * Binds GoogleSlidesService from host credentials and registers the generated
 * GoogleSlidesToolProvider with the shared provider registry.
 */
class GoogleSlidesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleSlidesService::class, function ($app): GoogleSlidesService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleSlidesService(accessToken: $creds?->get('google-slides', 'access_token', '') ?? '', baseUrl: $creds?->get('google-slides', 'url', 'https://slides.googleapis.com') ?? 'https://slides.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleSlidesToolProvider);
    }
}
