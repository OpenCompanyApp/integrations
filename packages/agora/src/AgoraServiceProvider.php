<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Agora Cloud Recording integration with Laravel.
 *
 * Binds the AgoraService singleton from stored REST credentials and registers
 * the AgoraToolProvider with the shared discovery registry when available.
 */
class AgoraServiceProvider extends ServiceProvider
{
    /**
     * Register the AgoraService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(AgoraService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AgoraService(
                customerId: $creds->get('agora', 'customer_id', ''),
                customerSecret: $creds->get('agora', 'customer_secret', $creds->get('agora', 'api_key', '')),
                appId: $creds->get('agora', 'app_id', ''),
                baseUrl: $creds->get('agora', 'url', 'https://api.sd-rtn.com'),
            );
        });
    }

    /**
     * Boot the service provider by registering the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AgoraToolProvider());
        }
    }
}
