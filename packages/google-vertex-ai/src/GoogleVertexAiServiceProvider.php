<?php

namespace OpenCompany\Integrations\GoogleVertexAi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Vertex AI integration with Laravel's service container.
 *
 * Binds GoogleVertexAiService from host credentials and registers the generated
 * GoogleVertexAiToolProvider with the shared provider registry.
 */
class GoogleVertexAiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleVertexAiService::class, function ($app): GoogleVertexAiService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleVertexAiService(accessToken: $creds?->get('google-vertex-ai', 'access_token', '') ?? '', baseUrl: $creds?->get('google-vertex-ai', 'url', 'https://aiplatform.googleapis.com') ?? 'https://aiplatform.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleVertexAiToolProvider);
    }
}