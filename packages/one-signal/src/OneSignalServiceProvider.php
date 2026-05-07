<?php

namespace OpenCompany\Integrations\OneSignal;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the OneSignal integration.
 *
 * Registers the {@see OneSignalService} as a singleton and boots the
 * {@see OneSignalToolProvider} into the {@see ToolProviderRegistry}.
 */
class OneSignalServiceProvider extends ServiceProvider
{
    /**
     * Register the OneSignal service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(OneSignalService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OneSignalService(
                apiKey: $creds->get('one-signal', 'api_key', ''),
                appId: $creds->get('one-signal', 'app_id', ''),
                baseUrl: $creds->get('one-signal', 'url', 'https://api.onesignal.com'),
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
                ->register(new OneSignalToolProvider());
        }
    }
}
