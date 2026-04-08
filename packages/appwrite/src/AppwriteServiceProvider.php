<?php

namespace OpenCompany\Integrations\Appwrite;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AppwriteServiceProvider extends ServiceProvider
{
    /**
     * Register the Appwrite service as a singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AppwriteService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AppwriteService(
                apiKey: $creds->get('appwrite', 'api_key', ''),
                projectId: $creds->get('appwrite', 'project_id', ''),
                baseUrl: $creds->get('appwrite', 'url', 'https://cloud.appwrite.io/v1'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AppwriteToolProvider());
        }
    }
}
