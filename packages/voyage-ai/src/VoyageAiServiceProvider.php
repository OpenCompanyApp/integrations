<?php

namespace OpenCompany\Integrations\VoyageAi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Voyage AI integration with Laravel's service container.
 *
 * Binds VoyageAiService using configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry during boot.
 */
class VoyageAiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VoyageAiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new VoyageAiService(
                apiKey: $creds->get('voyage-ai', 'api_key', ''),
                baseUrl: $creds->get('voyage-ai', 'url', 'https://api.voyageai.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new VoyageAiToolProvider());
        }
    }
}
