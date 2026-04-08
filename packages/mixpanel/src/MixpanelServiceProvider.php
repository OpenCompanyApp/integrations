<?php

namespace OpenCompany\Integrations\Mixpanel;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * MixpanelServiceProvider — Laravel service provider for the Mixpanel integration.
 *
 * Registers the MixpanelService singleton (resolving credentials from the
 * CredentialResolver) and boots the tool provider into the ToolProviderRegistry.
 */
class MixpanelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MixpanelService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MixpanelService(
                apiKey: $creds->get('mixpanel', 'api_key', ''),
                baseUrl: $creds->get('mixpanel', 'url', 'https://api.mixpanel.com/v1'),
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
