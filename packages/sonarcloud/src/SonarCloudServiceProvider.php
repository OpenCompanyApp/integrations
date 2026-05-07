<?php

namespace OpenCompany\Integrations\SonarCloud;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the SonarCloud integration with Laravel's service container.
 *
 * Binds SonarCloudService from host credentials and registers SonarCloudToolProvider
 * with the shared provider registry when available.
 */
class SonarCloudServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(SonarCloudService::class, function ($app): SonarCloudService { $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null; return new SonarCloudService(apiToken: $creds?->get('sonarcloud', 'api_token', '') ?? '', baseUrl: $creds?->get('sonarcloud', 'url', 'https://sonarcloud.io') ?? 'https://sonarcloud.io'); }); }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new SonarCloudToolProvider); }
}
