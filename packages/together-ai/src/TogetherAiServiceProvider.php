<?php

namespace OpenCompany\Integrations\TogetherAi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TogetherAiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TogetherAiService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TogetherAiService(
                apiKey: $creds->get('together-ai', 'api_key', ''),
                baseUrl: $creds->get('together-ai', 'url', 'https://api.together.xyz/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TogetherAiToolProvider());
        }
    }
}
