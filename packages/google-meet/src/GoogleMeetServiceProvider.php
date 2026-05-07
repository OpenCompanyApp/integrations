<?php

namespace OpenCompany\Integrations\GoogleMeet;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Meet integration with Laravel's service container.
 *
 * Binds GoogleMeetService from host credentials and registers the generated
 * GoogleMeetToolProvider with the shared provider registry.
 */
class GoogleMeetServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleMeetService::class, function ($app): GoogleMeetService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleMeetService(accessToken: $creds?->get('google-meet', 'access_token', '') ?? '', baseUrl: $creds?->get('google-meet', 'url', 'https://meet.googleapis.com') ?? 'https://meet.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleMeetToolProvider);
    }
}