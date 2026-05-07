<?php

namespace OpenCompany\Integrations\Helicone;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Helicone integration with Laravel's service container.
 *
 * Binds HeliconeService from configured credentials and registers the tool
 * provider with the shared ToolProviderRegistry when the host exposes it.
 */
class HeliconeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HeliconeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HeliconeService(
                apiKey: $creds->get('helicone', 'api_key', ''),
                apiUrl: $creds->get('helicone', 'api_url', 'https://api.helicone.ai'),
                gatewayUrl: $creds->get('helicone', 'gateway_url', 'https://ai-gateway.helicone.ai'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HeliconeToolProvider());
        }
    }
}
