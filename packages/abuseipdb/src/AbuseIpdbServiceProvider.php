<?php

namespace OpenCompany\Integrations\AbuseIpdb;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the AbuseIPDB integration with Laravel's service container.
 *
 * Binds AbuseIpdbService using host credentials and registers the tool provider
 * with the ToolProviderRegistry during boot.
 */
class AbuseIpdbServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AbuseIpdbService::class, function ($app): AbuseIpdbService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new AbuseIpdbService(apiKey: $creds?->get('abuseipdb', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new AbuseIpdbToolProvider);
        }
    }
}
