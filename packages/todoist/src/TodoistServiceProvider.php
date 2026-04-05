<?php

namespace OpenCompany\Integrations\Todoist;

use Illuminate\Support\ServiceProvider;
use OpenCompany\Integrations\Core\Contracts\CredentialResolver;
use OpenCompany\Integrations\Core\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Todoist integration package.
 */
class TodoistServiceProvider extends ServiceProvider
{
    /**
     * Register the TodoistService singleton and bind credentials from the resolver.
     */
    public function register(): void
    {
        $this->app->singleton(TodoistService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TodoistService(
                apiToken: $creds->get('todoist', 'api_token', ''),
            );
        });
    }

    /**
     * Boot the service provider by registering the Todoist tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TodoistToolProvider());
        }
    }
}
