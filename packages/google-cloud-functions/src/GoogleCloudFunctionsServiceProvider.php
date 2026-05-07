<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Google Cloud Functions integration with Laravel's service container.
 *
 * Binds GoogleCloudFunctionsService from host credentials and registers the
 * generated GoogleCloudFunctionsToolProvider with the shared provider registry.
 */
class GoogleCloudFunctionsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleCloudFunctionsService::class, function ($app): GoogleCloudFunctionsService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new GoogleCloudFunctionsService(accessToken: $creds?->get('google-cloud-functions', 'access_token', '') ?? '', baseUrl: $creds?->get('google-cloud-functions', 'url', 'https://cloudfunctions.googleapis.com') ?? 'https://cloudfunctions.googleapis.com');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new GoogleCloudFunctionsToolProvider);
    }
}