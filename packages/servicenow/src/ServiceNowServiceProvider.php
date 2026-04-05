<?php

namespace OpenCompany\Integrations\ServiceNow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the ServiceNow integration package.
 *
 * Registers the {@see ServiceNowService} as a singleton using credentials
 * resolved from the integration core, and boots the tool provider into
 * the {@see ToolProviderRegistry}.
 */
class ServiceNowServiceProvider extends ServiceProvider
{
    /**
     * Register the ServiceNow service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ServiceNowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ServiceNowService(
                username: $creds->get('servicenow', 'username', ''),
                password: $creds->get('servicenow', 'password', ''),
                instance: $creds->get('servicenow', 'instance', ''),
            );
        });
    }

    /**
     * Boot the ServiceNow tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ServiceNowToolProvider());
        }
    }
}
