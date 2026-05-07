<?php

namespace OpenCompany\Integrations\LangSmith;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the LangSmith integration with Laravel's service container.
 *
 * Binds the LangSmith API client from host credentials and registers the
 * generated LangSmithToolProvider with the shared tool provider registry.
 */
class LangSmithServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LangSmithService::class, function (): LangSmithService {
            $credentials = $this->app->bound(CredentialResolver::class)
                ? $this->app->make(CredentialResolver::class)
                : null;

            return new LangSmithService(
                apiKey: $credentials?->get('langsmith', 'api_key', '') ?? '',
                bearerToken: $credentials?->get('langsmith', 'bearer_token', '') ?? '',
                tenantId: $credentials?->get('langsmith', 'tenant_id', '') ?? '',
                organizationId: $credentials?->get('langsmith', 'organization_id', '') ?? '',
                baseUrl: $credentials?->get('langsmith', 'base_url', 'https://api.smith.langchain.com') ?? 'https://api.smith.langchain.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new LangSmithToolProvider);
        }
    }
}