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
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('microsoft-todo', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('microsoft_todo', $key, $default);
            };

            return new MicrosoftTodoService(
                accessToken: $get('access_token'),
                baseUrl: $get('url', 'https://graph.microsoft.com/v1.0'),
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
