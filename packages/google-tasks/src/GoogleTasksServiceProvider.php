<?php

namespace OpenCompany\Integrations\GoogleTasks;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GoogleTasksServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleTasksService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleTasksService(
                accessToken: $creds->get('google-tasks', 'access_token', ''),
                baseUrl: $creds->get('google-tasks', 'url', 'https://tasks.googleapis.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleTasksToolProvider());
        }
    }
}
