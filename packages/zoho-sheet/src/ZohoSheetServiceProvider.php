<?php

namespace OpenCompany\Integrations\ZohoSheet;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * ZohoSheetServiceProvider — Laravel service provider for the Zoho Sheet integration.
 *
 * Registers the ZohoSheetService singleton (resolving credentials from the
 * CredentialResolver) and boots the ZohoSheetToolProvider into the ToolProviderRegistry.
 */
class ZohoSheetServiceProvider extends ServiceProvider
{
    /**
     * Register the ZohoSheetService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ZohoSheetService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ZohoSheetService(
                accessToken: $creds->get('zoho_sheet', 'access_token', ''),
                baseUrl: $creds->get('zoho_sheet', 'url', 'https://sheet.zoho.com'),
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
                ->register(new ZohoSheetToolProvider());
        }
    }
}
