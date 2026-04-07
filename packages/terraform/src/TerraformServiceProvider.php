<?php

namespace OpenCompany\Integrations\Terraform;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Terraform Cloud integration.
 *
 * Registers the TerraformService singleton and bootstraps the ToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class TerraformServiceProvider extends ServiceProvider
{
    /**
     * Register the TerraformService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(TerraformService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new TerraformService(
                apiToken: $creds->get('terraform', 'api_token', ''),
            );
        });
    }

    /**
     * Boot the service provider — register the ToolProvider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TerraformToolProvider());
        }
    }
}
