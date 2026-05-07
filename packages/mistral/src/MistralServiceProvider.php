<?php

namespace OpenCompany\Integrations\Mistral;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Mistral AI integration with Laravel's service container.
 *
 * Binds MistralService from configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry when available.
 */
class MistralServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MistralService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $apiKey = (string) $creds->get('mistral', 'api_key', '');
            $baseUrl = (string) $creds->get('mistral', 'base_url', '');

            if ($apiKey === '') {
                $apiKey = (string) $creds->get('mistralai', 'api_key', '');
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('mistralai', 'url', 'https://api.mistral.ai');
            }

            return new MistralService(
                apiKey: $apiKey,
                baseUrl: $baseUrl,
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MistralToolProvider());
        }
    }
}
