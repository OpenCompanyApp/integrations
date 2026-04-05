<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Pipedrive integration.
 *
 * Registers the PipedriveService singleton and bootstraps the Pipedrive tool provider.
 */
class PipedriveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PipedriveService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PipedriveService(
                apiToken: $creds->get('pipedrive', 'api_token', ''),
                companyDomain: $creds->get('pipedrive', 'company_domain', 'https://company.pipedrive.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PipedriveToolProvider());
        }
    }
}
