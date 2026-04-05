<?php

namespace OpenCompany\Integrations\JinaAI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * JinaAI Laravel Service Provider.
 *
 * Registers the JinaAIService singleton (resolving credentials from the
 * CredentialResolver) and boots the JinaAI ToolProvider into the
 * ToolProviderRegistry when available.
 */
class JinaAIServiceProvider extends ServiceProvider
{
    /**
     * Register the JinaAIService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(JinaAIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new JinaAIService(
                apiKey: $creds->get('jinaai', 'api_key', ''),
                baseUrl: $creds->get('jinaai', 'url', 'https://api.jina.ai/v1'),
            );
        });
    }

    /**
     * Boot the service provider — register tools with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new JinaAIToolProvider());
        }
    }
}
