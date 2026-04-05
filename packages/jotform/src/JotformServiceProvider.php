<?php

namespace OpenCompany\Integrations\Jotform;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class JotformServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(JotformService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new JotformService(
                apiKey: $creds->get('jotform', 'api_key', ''),
                baseUrl: $creds->get('jotform', 'url', 'https://api.jotform.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new JotformToolProvider());
        }
    }
}
