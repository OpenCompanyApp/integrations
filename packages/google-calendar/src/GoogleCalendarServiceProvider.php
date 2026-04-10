<?php

namespace OpenCompany\Integrations\GoogleCalendar;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Google\GoogleServiceProvider;

class GoogleCalendarServiceProvider extends ServiceProvider
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

        $this->app->singleton(GoogleCalendarService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleCalendarService(
                accessToken: $creds->get('google-calendar', 'access_token', ''),
                baseUrl: $creds->get('google-calendar', 'url', 'https://www.googleapis.com'),
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
                ->register(new GoogleCalendarToolProvider);
        }
    }
}
