<?php

namespace OpenCompany\Integrations\Groq;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GroqServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GroqService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GroqService(
                apiKey: $creds->get('groq', 'api_key', ''),
                baseUrl: $creds->get('groq', 'url', 'https://api.groq.com/openai/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GroqToolProvider());
        }
    }
}
