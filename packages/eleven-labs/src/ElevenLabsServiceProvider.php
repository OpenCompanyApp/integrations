<?php

namespace OpenCompany\Integrations\ElevenLabs;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ElevenLabsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ElevenLabsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ElevenLabsService(
                apiKey: $creds->get('eleven-labs', 'api_key', ''),
                baseUrl: $creds->get('eleven-labs', 'url', 'https://api.elevenlabs.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ElevenLabsToolProvider());
        }
    }
}
