<?php

namespace OpenCompany\Integrations\Smartsheet;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Smartsheet integration.
 *
 * Registers the SmartsheetService as a singleton and bootstraps
 * the SmartsheetToolProvider into the tool provider registry.
 */
class SmartsheetServiceProvider extends ServiceProvider
{
    /**
     * Register the Smartsheet service as a singleton.
     *
     * Resolves the access token from the credential store and binds
     * the SmartsheetService into the service container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(SmartsheetService::class, function () {
            return new SmartsheetService(
                accessToken: CredentialResolver::get('smartsheet', 'access_token', ''),
            );
        });
    }

    /**
     * Boot the Smartsheet integration by registering the tool provider.
     *
     * @param ToolProviderRegistry $registry The tool provider registry.
     * @return void
     */
    public function boot(ToolProviderRegistry $registry): void
    {
        $registry->register(new SmartsheetToolProvider());
    }
}
