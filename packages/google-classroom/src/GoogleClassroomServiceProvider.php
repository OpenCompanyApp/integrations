<?php

namespace OpenCompany\Integrations\GoogleClassroom;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Classroom integration with Laravel's service container.
 *
 * Binds GoogleClassroomService from host credentials and registers the generated
 * GoogleClassroomToolProvider with the shared provider registry.
 */
class GoogleClassroomServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleClassroomService::class, function ($app): GoogleClassroomService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleClassroomService(accessToken: $creds?->get('google-classroom', 'access_token', '') ?? '', baseUrl: $creds?->get('google-classroom', 'url', 'https://classroom.googleapis.com') ?? 'https://classroom.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleClassroomToolProvider);
    }
}