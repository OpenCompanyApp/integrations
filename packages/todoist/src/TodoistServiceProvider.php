<?php

namespace OpenCompany\Integrations\Todoist;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Todoist integration package.
 *
 * Registers the TodoistService singleton with credentials resolved from
 * the integration configuration, and bootstraps the tool provider registry.
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
                accessToken: $creds->get('todoist', 'access_token', ''),
                baseUrl: $creds->get('todoist', 'base_url', 'https://api.todoist.com'),
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
