<?php

namespace OpenCompany\Integrations\MicrosoftTodo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Microsoft To Do integration.
 *
 * Registers the MicrosoftTodoService as a singleton (resolving credentials from the
 * CredentialResolver) and bootstraps the MicrosoftTodoToolProvider into the
 * ToolProviderRegistry when available.
 */
class MicrosoftTodoServiceProvider extends ServiceProvider
{
    /**
     * Register the MicrosoftTodoService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(MicrosoftTodoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MicrosoftTodoService(
                accessToken: $creds->get('microsoft_todo', 'access_token', ''),
                baseUrl: $creds->get('microsoft_todo', 'url', 'https://graph.microsoft.com/v1.0'),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MicrosoftTodoToolProvider());
        }
    }
}
