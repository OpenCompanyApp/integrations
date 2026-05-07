<?php

namespace OpenCompany\Integrations\GoogleCloudRun;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Cloud Run integration with Laravel's service container.
 *
 * Binds GoogleCloudRunService from host credentials and registers the generated
 * GoogleCloudRunToolProvider with the shared provider registry.
 */
class GoogleCloudRunServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleCloudRunService::class, function ($app): GoogleCloudRunService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleCloudRunService(accessToken: $creds?->get('google-cloud-run', 'access_token', '') ?? '', baseUrl: $creds?->get('google-cloud-run', 'url', 'https://run.googleapis.com') ?? 'https://run.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleCloudRunToolProvider);
    }
}