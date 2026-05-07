<?php

namespace OpenCompany\Integrations\GoogleGemini;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Gemini integration with Laravel's service container.
 *
 * Binds GeminiService from host credentials and registers the generated
 * GeminiToolProvider with the shared provider registry.
 */
class GeminiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GeminiService::class, function ($app): GeminiService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GeminiService(apiKey: $creds?->get('google-gemini', 'api_key', '') ?? '', baseUrl: $creds?->get('google-gemini', 'url', 'https://generativelanguage.googleapis.com') ?? 'https://generativelanguage.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GeminiToolProvider);
    }
}
