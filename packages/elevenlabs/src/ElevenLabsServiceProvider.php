<?php

namespace OpenCompany\Integrations\ElevenLabs;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the ElevenLabs integration.
 *
 * Registers the ElevenLabsService singleton and boots the ToolProvider
 * into the ToolProviderRegistry when available.
 */
class ElevenLabsServiceProvider extends ServiceProvider
{
    /**
     * Register the ElevenLabsService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ElevenLabsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ElevenLabsService(
                apiKey: $creds->get('elevenlabs', 'api_key', ''),
                baseUrl: $creds->get('elevenlabs', 'url', 'https://api.elevenlabs.io/v1'),
            );
        });
    }

    /**
     * Boot the ToolProvider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ElevenLabsToolProvider());
        }
    }
}
