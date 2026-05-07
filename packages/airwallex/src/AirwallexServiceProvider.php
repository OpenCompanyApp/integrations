<?php

namespace OpenCompany\Integrations\Airwallex;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Airwallex integration with Laravel's service container.
 *
 * Binds AirwallexService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class AirwallexServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AirwallexService::class, function ($app): AirwallexService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new AirwallexService(
                accessToken: $creds?->get('airwallex', 'access_token', '') ?? '',
                clientId: $creds?->get('airwallex', 'client_id', '') ?? '',
                apiKey: $creds?->get('airwallex', 'api_key', '') ?? '',
                baseUrl: $creds?->get('airwallex', 'url', 'https://api-demo.airwallex.com') ?? 'https://api-demo.airwallex.com',
                fileUrl: $creds?->get('airwallex', 'file_url', 'https://files-demo.airwallex.com') ?? 'https://files-demo.airwallex.com',
                apiVersion: $creds?->get('airwallex', 'api_version', '') ?? '',
                loginAs: $creds?->get('airwallex', 'login_as', '') ?? '',
                onBehalfOf: $creds?->get('airwallex', 'on_behalf_of', '') ?? '',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new AirwallexToolProvider);
        }
    }
}
