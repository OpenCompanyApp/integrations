<?php

namespace OpenCompany\Integrations\Deepgram;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Deepgram integration with Laravel's service container.
 *
 * Binds DeepgramService from configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry when the host exposes it.
 */
class DeepgramServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DeepgramService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DeepgramService(
                apiKey: $creds->get('deepgram', 'api_key', ''),
                baseUrl: $creds->get('deepgram', 'url', 'https://api.deepgram.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DeepgramToolProvider());
        }
    }
}
