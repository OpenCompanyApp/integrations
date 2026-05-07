<?php

namespace OpenCompany\Integrations\Loops;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Loops integration with Laravel's service container.
 *
 * Binds the Loops API client and registers the tool provider when the host
 * application exposes the shared integration registry.
 */
class LoopsServiceProvider extends ServiceProvider
{
    /**
     * Register the Loops API service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(LoopsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LoopsService(
                apiKey: $creds->get('loops', 'api_key', ''),
                baseUrl: $creds->get('loops', 'url', 'https://app.loops.so/api/v1'),
            );
        });
    }

    /**
     * Register the Loops tool provider with the shared registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LoopsToolProvider());
        }
    }
}
