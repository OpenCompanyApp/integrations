<?php

namespace OpenCompany\Integrations\DeepL;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the DeepL integration with Laravel's service container.
 *
 * Binds the DeepL API client using host-provided credentials and registers
 * the DeepL tool provider with the shared registry when available.
 */
class DeepLServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DeepLService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DeepLService(
                apiKey: (string) $creds->get('deepl', 'api_key', ''),
                baseUrl: (string) $creds->get('deepl', 'base_url', 'https://api.deepl.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new DeepLToolProvider);
        }
    }
}