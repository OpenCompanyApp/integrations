<?php

namespace OpenCompany\Integrations\Contentful;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the ContentfulService singleton and bootstraps Contentful tools.
 */
class ContentfulServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ContentfulService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ContentfulService(
                accessToken: $creds->get('contentful', 'access_token', ''),
                spaceId: $creds->get('contentful', 'space_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ContentfulToolProvider());
        }
    }
}
