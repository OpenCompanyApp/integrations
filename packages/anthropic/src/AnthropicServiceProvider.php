<?php

namespace OpenCompany\Integrations\Anthropic;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Anthropic integration.
 *
 * Registers the AnthropicService as a singleton and bootstraps
 * the tool provider into the ToolProviderRegistry.
 */
class AnthropicServiceProvider extends ServiceProvider
{
    /**
     * Register the Anthropic service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(AnthropicService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AnthropicService(
                apiKey: $creds->get('anthropic', 'api_key', ''),
                baseUrl: $creds->get('anthropic', 'url', 'https://api.anthropic.com/v1'),
                adminKey: $creds->get('anthropic', 'admin_key', ''),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AnthropicToolProvider());
        }
    }
}
