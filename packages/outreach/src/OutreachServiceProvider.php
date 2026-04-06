<?php

namespace OpenCompany\Integrations\Outreach;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class OutreachServiceProvider extends ServiceProvider
{
    /**
     * Register the Outreach service as a singleton.
     *
     * Resolves credentials via the CredentialResolver and binds the
     * OutreachService instance into the container.
     */
    public function register(): void
    {
        $this->app->singleton(OutreachService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OutreachService(
                accessToken: $creds->get('outreach', 'access_token', ''),
                baseUrl: $creds->get('outreach', 'url', 'https://api.outreach.io/api/v2'),
            );
        });
    }

    /**
     * Boot the service provider.
     *
     * Registers the OutreachToolProvider with the ToolProviderRegistry
     * if the registry is bound in the container.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new OutreachToolProvider());
        }
    }
}
