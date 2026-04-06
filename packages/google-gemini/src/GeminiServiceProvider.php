<?php

namespace OpenCompany\Integrations\GoogleGemini;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GeminiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GeminiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GeminiService(
                apiKey: $creds->get('google-gemini', 'api_key', ''),
                baseUrl: $creds->get('google-gemini', 'url', 'https://generativelanguage.googleapis.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GeminiToolProvider());
        }
    }
}
