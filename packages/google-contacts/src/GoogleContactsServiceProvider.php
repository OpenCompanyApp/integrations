<?php

namespace OpenCompany\Integrations\GoogleContacts;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Google Contacts integration.
 *
 * Registers the GoogleContactsService singleton (resolving credentials from the
 * CredentialResolver) and boots the tool provider into the ToolProviderRegistry
 * when available.
 */
class GoogleContactsServiceProvider extends ServiceProvider
{
    /**
     * Register the GoogleContactsService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(GoogleContactsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleContactsService(
                accessToken: $creds->get('google_contacts', 'access_token', ''),
                baseUrl: $creds->get('google_contacts', 'url', 'https://people.googleapis.com'),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleContactsToolProvider());
        }
    }
}
