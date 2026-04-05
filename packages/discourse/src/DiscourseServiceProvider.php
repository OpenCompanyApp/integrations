<?php

namespace OpenCompany\Integrations\Discourse;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Discourse integration.
 *
 * Registers the DiscourseService as a singleton (resolving credentials from
 * the CredentialResolver) and boots the DiscourseToolProvider into the
 * ToolProviderRegistry for auto-discovery.
 */
class DiscourseServiceProvider extends ServiceProvider
{
    /**
     * Register the DiscourseService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(DiscourseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DiscourseService(
                apiKey: $creds->get('discourse', 'api_key', ''),
                apiUsername: $creds->get('discourse', 'api_username', ''),
                hostname: $creds->get('discourse', 'hostname', ''),
            );
        });
    }

    /**
     * Boot the DiscourseToolProvider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DiscourseToolProvider());
        }
    }
}
