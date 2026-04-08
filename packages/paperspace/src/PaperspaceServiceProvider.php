<?php

namespace OpenCompany\Integrations\Paperspace;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PaperspaceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PaperspaceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PaperspaceService(
                accessToken: $creds->get('paperspace', 'access_token', ''),
                baseUrl: $creds->get('paperspace', 'url', 'https://api.paperspace.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PaperspaceToolProvider());
        }
    }
}
