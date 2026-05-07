<?php

namespace OpenCompany\Integrations\RetellAI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Retell AI integration with Laravel's service container.
 *
 * Binds the API client with stored credentials and registers the provider with
 * the shared tool registry when available.
 */
class RetellAIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RetellAIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $apiKey = $creds->get('retell-ai', 'api_key', '')
                ?: $creds->get('retell', 'api_key', '')
                ?: $creds->get('retell', 'access_token', '');
            $baseUrl = $creds->get('retell-ai', 'url', '')
                ?: $creds->get('retell', 'url', 'https://api.retellai.com');

            return new RetellAIService(
                apiKey: $apiKey,
                baseUrl: $baseUrl,
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RetellAIToolProvider());
        }
    }
}
