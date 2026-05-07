<?php

namespace OpenCompany\Integrations\Capsule;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Auto-discovered Laravel service provider for Capsule CRM.
 *
 * Registers the CapsuleService singleton (resolving credentials from the
 * CredentialResolver) and boots the CapsuleToolProvider into the
 * ToolProviderRegistry when available.
 */
class CapsuleServiceProvider extends ServiceProvider
{
    /**
     * Register the Capsule CRM API client singleton.
     */
    public function register(): void
    {
        $this->app->singleton(CapsuleService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CapsuleService(
                accessToken: $creds->get('capsule', 'access_token', ''),
                baseUrl: $creds->get('capsule', 'url', 'https://api.capsulecrm.com/api/v2'),
            );
        });
    }

    /**
     * Register the Capsule CRM tool provider with the host registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CapsuleToolProvider());
        }
    }
}
