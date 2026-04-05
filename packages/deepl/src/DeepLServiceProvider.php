<?php

namespace OpenCompany\Integrations\DeepL;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the DeepL integration.
 *
 * Registers the DeepLService singleton and boots the ToolProvider
 * into the ToolProviderRegistry when available.
 */
class DeepLServiceProvider extends ServiceProvider
{
    /**
     * Register the DeepLService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(DeepLService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DeepLService(
                authKey: $creds->get('deepl', 'auth_key', ''),
                isFree: (bool) ($creds->get('deepl', 'is_free', false)),
            );
        });
    }

    /**
     * Boot the service provider and register the ToolProvider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DeepLToolProvider());
        }
    }
}
