<?php

namespace OpenCompany\Integrations\GoogleCalendar;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Calendar integration with Laravel's service container.
 *
 * Binds GoogleCalendarService from host credentials and registers the generated
 * GoogleCalendarToolProvider with the shared provider registry.
 */
class GoogleCalendarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleCalendarService::class, function ($app): GoogleCalendarService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleCalendarService(accessToken: $creds?->get('google-calendar', 'access_token', '') ?? '', baseUrl: $creds?->get('google-calendar', 'url', 'https://www.googleapis.com/calendar/v3') ?? 'https://www.googleapis.com/calendar/v3');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleCalendarToolProvider);
    }
}
