<?php

namespace OpenCompany\Integrations\Docker;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class DockerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DockerService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DockerService(
                accessToken: $creds->get('docker', 'access_token', ''),
                baseUrl: $creds->get('docker', 'url', 'https://hub.docker.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DockerToolProvider());
        }
    }
}
