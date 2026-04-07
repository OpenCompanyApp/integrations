<?php

namespace OpenCompany\Integrations\Firebase;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register the Firebase service as a singleton.
     */
    public function register(): void
    {
        $this->app->singleton(FirebaseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FirebaseService(
                accessToken: $creds->get('firebase', 'access_token', ''),
                projectId: $creds->get('firebase', 'project_id', ''),
                baseUrl: $creds->get('firebase', 'url', 'https://firebase.googleapis.com/v1'),
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
                ->register(new FirebaseToolProvider());
        }
    }
}
