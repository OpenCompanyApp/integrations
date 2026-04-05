<?php

namespace OpenCompany\Integrations\PagerDuty;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the PagerDuty integration package.
 *
 * Registers the {@see PagerDutyService} as a singleton resolved from
 * configuration credentials and boots the {@see PagerDutyToolProvider}
 * into the central {@see ToolProviderRegistry}.
 */
class PagerDutyServiceProvider extends ServiceProvider
{
    /**
     * Register the PagerDuty service as a singleton.
     *
     * Credentials are read from the application configuration via the
     * {@see CredentialResolver}. The service is only instantiated when
     * actually resolved from the container.
     */
    public function register(): void
    {
        $this->app->singleton(PagerDutyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PagerDutyService(
                apiToken: $creds->get('pagerduty', 'api_token', ''),
            );
        });
    }

    /**
     * Boot the PagerDuty tool provider into the registry.
     *
     * The provider is only registered when the {@see ToolProviderRegistry}
     * is bound in the container, which typically happens when the core
     * integration package is installed.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PagerDutyToolProvider());
        }
    }
}
