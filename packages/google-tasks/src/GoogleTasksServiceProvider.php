<?php

namespace OpenCompany\Integrations\GoogleTasks;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Tasks integration with Laravel's service container.
 *
 * Binds GoogleTasksService from host credentials and registers the generated
 * GoogleTasksToolProvider with the shared provider registry.
 */
class GoogleTasksServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleTasksService::class, function ($app): GoogleTasksService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleTasksService(accessToken: $creds?->get('google-tasks', 'access_token', '') ?? '', baseUrl: $creds?->get('google-tasks', 'url', 'https://tasks.googleapis.com') ?? 'https://tasks.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleTasksToolProvider);
    }
}
