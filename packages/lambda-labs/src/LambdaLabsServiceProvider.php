<?php

namespace OpenCompany\Integrations\LambdaLabs;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class LambdaLabsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LambdaLabsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LambdaLabsService(
                apiKey: $creds->get('lambda-labs', 'api_key', ''),
                baseUrl: $creds->get('lambda-labs', 'url', 'https://cloud.lambdalabs.com/api/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LambdaLabsToolProvider());
        }
    }
}
