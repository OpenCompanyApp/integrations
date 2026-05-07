<?php

namespace OpenCompany\Integrations\Nvd;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the NVD integration with Laravel's service container.
 *
 * Binds NvdService with optional API-key credentials and registers the tool
 * provider with the shared ToolProviderRegistry during boot.
 */
class NvdServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NvdService::class, function ($app): NvdService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new NvdService(apiKey: $creds?->get('nvd', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new NvdToolProvider);
        }
    }
}
