<?php

namespace OpenCompany\Integrations\Docker;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Docker Hub integration with Laravel's service container.
 *
 * Binds the API service and registers the generated tool provider.
 */
class DockerServiceProvider extends ServiceProvider
{
    /**
     * Register the Docker Hub service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(DockerService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DockerService(
                accessToken: $creds->get('docker', 'access_token', ''),
                baseUrl: $creds->get('docker', 'url', 'https://hub.docker.com'),
            );
        });
    }

    /**
     * Register the tool provider when the host registry is available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DockerToolProvider());
        }
    }
}
