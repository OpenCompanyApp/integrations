<?php

namespace OpenCompany\Integrations\RetellAI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RetellAIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RetellAIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RetellAIService(
                apiKey: $creds->get('retell-ai', 'api_key', ''),
                baseUrl: $creds->get('retell-ai', 'url', 'https://api.retellai.com/v2'),
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
