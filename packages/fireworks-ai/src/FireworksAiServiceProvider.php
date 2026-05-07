<?php

namespace OpenCompany\Integrations\FireworksAi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Fireworks AI integration with Laravel's service container.
 *
 * Binds FireworksAiService from configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry when available.
 */
class FireworksAiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FireworksAiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FireworksAiService(
                apiKey: $creds->get('fireworks-ai', 'api_key', ''),
                baseUrl: $creds->get('fireworks-ai', 'base_url', 'https://api.fireworks.ai'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FireworksAiToolProvider());
        }
    }
}
