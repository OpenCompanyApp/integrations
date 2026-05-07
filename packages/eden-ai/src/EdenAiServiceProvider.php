<?php

namespace OpenCompany\Integrations\EdenAi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Eden AI integration with Laravel's service container.
 */
class EdenAiServiceProvider extends ServiceProvider
{
    /**
     * Register the Eden AI API client singleton.
     */
    public function register(): void
    {
        $this->app->singleton(EdenAiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new EdenAiService(
                apiKey: $creds->get('eden-ai', 'api_key', ''),
                baseUrl: $creds->get('eden-ai', 'url', 'https://api.edenai.run/v2'),
                v3BaseUrl: $creds->get('eden-ai', 'v3_url', 'https://api.edenai.run/v3'),
            );
        });
    }

    /**
     * Register the Eden AI tool provider when the registry is available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new EdenAiToolProvider());
        }
    }
}
