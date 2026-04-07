<?php

namespace OpenCompany\Integrations\Todoist;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TodoistServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TodoistService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new TodoistService(
                accessToken: $creds->get('todoist', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TodoistToolProvider());
        }
    }
}
