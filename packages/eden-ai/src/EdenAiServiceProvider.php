<?php

namespace OpenCompany\Integrations\EdenAi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class EdenAiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EdenAiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new EdenAiService(
                apiKey: $creds->get('eden-ai', 'api_key', ''),
                baseUrl: $creds->get('eden-ai', 'url', 'https://api.edenai.run/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new EdenAiToolProvider());
        }
    }
}
