<?php

namespace OpenCompany\Integrations\GoogleSlides;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GoogleSlidesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleSlidesService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleSlidesService(
                accessToken: $creds->get('google-slides', 'access_token', ''),
                baseUrl: $creds->get('google-slides', 'url', 'https://slides.googleapis.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleSlidesToolProvider());
        }
    }
}
