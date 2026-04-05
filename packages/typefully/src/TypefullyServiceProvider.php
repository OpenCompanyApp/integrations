<?php

namespace OpenCompany\Integrations\Typefully;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TypefullyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TypefullyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TypefullyService(
                apiKey: $creds->get('typefully', 'api_key', ''),
                baseUrl: $creds->get('typefully', 'url', 'https://api.typefully.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TypefullyToolProvider());
        }
    }
}
