<?php

namespace OpenCompany\Integrations\BambooHR;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BambooHRServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BambooHRService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BambooHRService(
                apiKey: $creds->get('bamboohr', 'api_key', ''),
                subdomain: $creds->get('bamboohr', 'subdomain', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BambooHRToolProvider());
        }
    }
}
