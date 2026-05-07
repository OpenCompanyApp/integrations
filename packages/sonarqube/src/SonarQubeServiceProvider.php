<?php

namespace OpenCompany\Integrations\SonarQube;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the SonarQube integration with Laravel's service container.
 *
 * Binds SonarQubeService from host credentials and registers SonarQubeToolProvider
 * with the shared provider registry when available.
 */
class SonarQubeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SonarQubeService::class, function ($app): SonarQubeService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new SonarQubeService(
                apiToken: $creds?->get('sonarqube', 'api_token', '') ?? '',
                baseUrl: $creds?->get('sonarqube', 'url', 'https://next.sonarqube.com/sonarqube') ?? 'https://next.sonarqube.com/sonarqube',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new SonarQubeToolProvider);
        }
    }
}
