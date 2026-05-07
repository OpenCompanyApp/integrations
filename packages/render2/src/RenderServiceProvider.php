<?php

namespace OpenCompany\Integrations\Render2;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Render integration with Laravel's service container.
 *
 * Binds the Render API client from configured credentials and registers the
 * Render tool provider with the shared integration registry.
 */
class RenderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RenderService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RenderService(
                apiKey: $creds->get('render', 'api_key', '') ?: $creds->get('render2', 'api_key', ''),
                baseUrl: $creds->get('render', 'url', '') ?: $creds->get('render2', 'url', 'https://api.render.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RenderToolProvider());
        }
    }
}
