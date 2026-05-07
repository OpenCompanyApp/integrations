<?php

namespace OpenCompany\Integrations\Cursor;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Cursor Admin API integration with Laravel.
 */
class CursorServiceProvider extends ServiceProvider
{
    /**
     * Register the Cursor service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(CursorService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CursorService(
                apiKey: $creds->get('cursor', 'api_key', ''),
                baseUrl: $creds->get('cursor', 'url', 'https://api.cursor.com'),
            );
        });
    }

    /**
     * Boot the Cursor service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CursorToolProvider());
        }
    }
}
