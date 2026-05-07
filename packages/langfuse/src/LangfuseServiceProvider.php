<?php

namespace OpenCompany\Integrations\Langfuse;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Langfuse integration with Laravel's service container.
 *
 * Binds LangfuseService using project API credentials and registers the tool
 * provider with the shared ToolProviderRegistry when the host exposes it.
 */
class LangfuseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LangfuseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new LangfuseService(
                publicKey: $creds->get('langfuse', 'public_key', ''),
                secretKey: $creds->get('langfuse', 'secret_key', ''),
                baseUrl: $creds->get('langfuse', 'url', 'https://cloud.langfuse.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new LangfuseToolProvider());
        }
    }
}
