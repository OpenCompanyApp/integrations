<?php

namespace OpenCompany\Integrations\Formstack;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * FormstackServiceProvider — Laravel service provider for the Formstack integration.
 *
 * Registers the FormstackService as a singleton (resolving credentials from the
 * CredentialResolver) and boots the FormstackToolProvider into the ToolProviderRegistry.
 */
class FormstackServiceProvider extends ServiceProvider
{
    /**
     * Register the FormstackService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(FormstackService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FormstackService(
                accessToken: $creds->get('formstack', 'access_token', ''),
            );
        });
    }

    /**
     * Boot the service provider — register tools with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FormstackToolProvider());
        }
    }
}
