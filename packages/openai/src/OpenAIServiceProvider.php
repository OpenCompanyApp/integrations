<?php

namespace OpenCompany\Integrations\OpenAI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the OpenAI integration.
 *
 * Registers the OpenAIService singleton and bootstraps the OpenAI tool provider.
 */
class OpenAIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenAIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OpenAIService(
                apiKey: $creds->get('openai', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new OpenAIToolProvider());
        }
    }
}
