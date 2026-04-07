<?php

namespace OpenCompany\Integrations\Linkedin;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the LinkedinService singleton and bootstraps LinkedIn tools.
 */
class LinkedinServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LinkedinService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LinkedinService(
                accessToken: $creds->get('linkedin', 'access_token', ''),
                baseUrl: $creds->get('linkedin', 'base_url', 'https://api.linkedin.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LinkedinToolProvider());
        }
    }
}
