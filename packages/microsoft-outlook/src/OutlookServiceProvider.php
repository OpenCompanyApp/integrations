<?php

namespace OpenCompany\Integrations\MicrosoftOutlook;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Microsoft Outlook integration.
 *
 * Registers the OutlookService singleton (resolving credentials from the
 * CredentialResolver) and boots the OutlookToolProvider into the
 * ToolProviderRegistry when available.
 */
class OutlookServiceProvider extends ServiceProvider
{
    /**
     * Register the OutlookService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(OutlookService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new OutlookService(
                accessToken: $creds->get('microsoft-outlook', 'access_token', ''),
                baseUrl: $creds->get('microsoft-outlook', 'base_url', 'https://graph.microsoft.com/v1.0'),
            );
        });
    }

    /**
     * Boot the tool provider into the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new OutlookToolProvider());
        }
    }
}
