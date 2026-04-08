<?php

namespace OpenCompany\Integrations\Telnyx;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Telnyx integration with Laravel's service container.
 *
 * Binds TelnyxService as a singleton using credentials from CredentialResolver,
 * and registers the TelnyxToolProvider with the ToolProviderRegistry on boot.
 */
class TelnyxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TelnyxService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TelnyxService(
                apiKey: $creds->get('telnyx', 'api_key', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TelnyxToolProvider());
        }
    }
}
