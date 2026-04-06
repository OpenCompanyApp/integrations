<?php

namespace OpenCompany\Integrations\Matrix;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MatrixServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MatrixService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MatrixService(
                accessToken: $creds->get('matrix', 'access_token', ''),
                baseUrl: $creds->get('matrix', 'url', 'https://matrix.org'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MatrixToolProvider());
        }
    }
}
