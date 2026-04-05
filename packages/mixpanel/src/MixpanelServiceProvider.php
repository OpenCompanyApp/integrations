<?php

namespace OpenCompany\Integrations\Mixpanel;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Mixpanel integration.
 *
 * Registers the MixpanelService singleton and bootstraps the Mixpanel tool provider.
 */
class MixpanelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MixpanelService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MixpanelService(
                username: $creds->get('mixpanel', 'username', ''),
                secret: $creds->get('mixpanel', 'secret', ''),
                projectId: $creds->get('mixpanel', 'project_id', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MixpanelToolProvider());
        }
    }
}
