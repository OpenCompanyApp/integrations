<?php

namespace OpenCompany\Integrations\CircleCI;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the CircleCI integration with Laravel's service container.
 *
 * Binds CircleCIService with host-provided credentials and registers the tool
 * provider when the integration registry is available.
 */
class CircleCIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CircleCIService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CircleCIService(
                accessToken: (string) $creds->get('circleci', 'access_token', ''),
                baseUrl: (string) $creds->get('circleci', 'url', 'https://circleci.com/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CircleCIToolProvider());
        }
    }
}
