<?php

namespace OpenCompany\Integrations\MistralAI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MistralAIServiceProvider extends ServiceProvider
{
    /**
     * Register the MistralAI service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(MistralAIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MistralAIService(
                apiKey: $creds->get('mistralai', 'api_key', ''),
                baseUrl: $creds->get('mistralai', 'url', 'https://api.mistral.ai/v1'),
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
                ->register(new MistralAIToolProvider());
        }
    }
}
