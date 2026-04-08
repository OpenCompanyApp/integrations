<?php

namespace OpenCompany\Integrations\Perplexity;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PerplexityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PerplexityService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PerplexityService(
                apiKey: $creds->get('perplexity', 'api_key', ''),
                baseUrl: $creds->get('perplexity', 'url', 'https://api.perplexity.ai'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PerplexityToolProvider());
        }
    }
}
